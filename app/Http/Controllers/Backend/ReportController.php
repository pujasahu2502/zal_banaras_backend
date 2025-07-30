<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\{User, Order, OrderItem};
use App\Models\{User, Category, Attribute, Product, Order, Blog, Dealer,OrderItem};
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller{
    /* ===== CUSTOMER REPORT ===== */
    public function customerReport(Request $request){
        try {
            $allUser = [];
            $allOrder = [];
            $reports = [];
            $userReports = [];
            $yearRequest = $request['year'] = $request['year'] ? $request['year'] : date('Y');
            $yearRequest = $request['year'];
            $request['sr'] = $request['year'] == date('Y') ?  $request['sr'] : 'ty';

            /* ========== FILTER GRAPH ========== */
            if($request->sr != null){

                $flag = 1;

                if($request->sr == 'tw'){

                    /* === SIGNUP USER === */
                    $allUser = [
                        'customer' => User::role('user')->where('type', 'customer')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),

                        'guest' => User::role('user')->where('type', 'guest')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                    ];

                    /* === CUSTOMER GUEST SALES "PIE CHART" === */
                    $orders = Order::with('customer')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();
                    $allOrder = [
                        'customerUser' => collect($orders)->where('customer.type', 'customer')->count(),
                        'guestUser' => collect($orders)->where('customer.type', 'guest')->count(),
                    ];

                    /* === CUSTOMER SALES AND CUSTOMERS "BAR CHART" === */
                    $weekPeriodDate = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
                    $weekDate = json_decode(json_encode ( $weekPeriodDate ) , true);

                    for ($week = 0; $week <= 6; $week++) {

                        /* === SALES REPORT === */
                        $totalSale = Order::with('customer')->whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();

                        $reports[$week] = [
                            'y' => collect($totalSale)->where('customer.type', 'customer')->count(),
                            'label' => jddayofweek($week, 1)
                        ];

                        /* === CUSTOMER REPORT === */
                        $userReports[$week] = [
                            'y' => User::role('user')->where('type', 'customer')->whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                            'label' => jddayofweek($week, 1)
                        ];
                    }
                }elseif($request->sr == 'tm'){

                    /* === SIGNUP USER === */
                    $allUser = [
                        'customer' => User::role('user')->where('type', 'customer')->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),

                        'guest' => User::role('user')->where('type', 'guest')->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                    ];

                    /* === CUSTOMER GUEST SALES "PIE CHART" === */
                    $orders = Order::with('customer')->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();
                    $allOrder = [
                        'customerUser' => collect($orders)->where('customer.type', 'customer')->count(),
                        'guestUser' => collect($orders)->where('customer.type', 'guest')->count(),
                    ];

                    /* === CUSTOMER SALES AND CUSTOMERS "BAR CHART" === */
                    $date = date('d');
                    if($date > 0){
                        for ($month = 0; $month < $date; $month++) {

                            /* === SALES REPORT === */
                            $totalSale = Order::with('customer')->whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();
                            $reports[$month] = [
                                'y' => collect($totalSale)->where('customer.type', 'customer')->count(),
                                'label' => ($month+1)
                            ];

                            /* === CUSTOMER REPORT === */
                            $userReports[$month] = [
                                'y' => User::role('user')->where('type', 'customer')->whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                                'label' => ($month+1)
                            ];
                        }
                    }
                }elseif($request->sr == 'ty'){

                    /* === SIGNUP USER === */
                   $allUser = [
                        'customer' => User::role('user')->where('type', 'customer')->whereYear('created_at', $yearRequest)->count(),

                        'guest' => User::role('user')->where('type', 'guest')->whereYear('created_at', $yearRequest)->count(),
                    ];

                    /* === CUSTOMER GUEST SALES "PIE CHART" === */
                    $orders = Order::with('customer')->whereYear('created_at', $yearRequest)->get();
                    $allOrder = [
                        'customerUser' => collect($orders)->where('customer.type', 'customer')->count(),
                        'guestUser' => collect($orders)->where('customer.type', 'guest')->count(),
                    ];

                    /* === CUSTOMER SALES AND CUSTOMERS "BAR CHART" === */
                    $currentMonth = $yearRequest == date('Y') ? date('m') : 12;
                    if($currentMonth > 0){
                        for ($year = 0; $year < $currentMonth; $year++) {

                            /* === SALES REPORT === */
                            $totalSale = Order::with('customer')->whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->get();
                            $month = date("F", mktime(0, 0, 0, ($year+1), 10));
                            $reports[$year] = [
                                'y' => collect($totalSale)->where('customer.type', 'customer')->count(),
                                'label' => $month
                            ];

                            /* === CUSTOMER REPORT === */
                            $userReports[$year] = [
                                'y' => User::role('user')->where('type', 'customer')->whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->count(),
                                'label' => $month
                            ];
                        }
                    }
                }
            }else{
                /* === SIGNUP USER === */
                $allUser = [
                    'customer' => User::role('user')->where('type', 'customer')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),

                    'guest' => User::role('user')->where('type', 'guest')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                ];

                /* === CUSTOMER GUEST SALES "PIE CHART" === */
                $orders = Order::with('customer')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();
                $allOrder = [
                    'customerUser' => collect($orders)->where('customer.type', 'customer')->count(),
                    'guestUser' => collect($orders)->where('customer.type', 'guest')->count(),
                ];

                /* === CUSTOMER SALES AND CUSTOMERS "BAR CHART" === */
                $weekPeriodDate = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
                $weekDate = json_decode(json_encode ( $weekPeriodDate ) , true);

                for ($week = 0; $week <= 6; $week++) {

                    /* === SALES REPORT === */
                    $totalSale = Order::with('customer')->whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->get();

                    $reports[$week] = [
                        'y' => collect($totalSale)->where('customer.type', 'customer')->count(),
                        'label' => jddayofweek($week, 1)
                    ];

                    /* === CUSTOMER REPORT === */
                    $userReports[$week] = [
                        'y' => User::role('user')->where('type', 'customer')->whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                        'label' => jddayofweek($week, 1)
                    ];
                }
            }

            return view('backend.report.customer-report', compact('allUser', 'allOrder', 'reports', 'userReports'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return abort(500);
        }
    }

    /* ===== ORDER REPORT ===== */
    public function orderReport(Request $request){
        try {
            /* ========== FILTER GRAPH ========== */  
            $grossSale = 0;
            $netSale = 0;
            $orderPlaced = 0;
            $itemPurchased = 0;
            $reports = [];
            $grossSaleData = [];
            $netSaleData = [];
            $itemPurchasedData = [];

            $yearRequest = $request['year'] = $request['year'] ? $request['year'] : date('Y');
            $request['sr'] = $request['year'] == date('Y') ?  $request['sr'] : 'ty';

            if($request->sr != null){
                $flag = 1;
                if($request->sr == 'tw'){

                    /* === TOTAL GROSS SALES === */
                    $grossSale = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('amount');

                    /* === TOTAL NET SALES === */
                    $netSale = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('sell_price');

                    /* === TOTAL ORDER PLACED === */
                    $orderPlaced = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count();

                    /* === ITEMS PURCHASED ===*/
                    $itemPurchased = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count();

                    /* ===== SALES AND ORDER "BAR CHART" ===== */
                    $weekPeriodDate = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
                    $weekDate = json_decode(json_encode ( $weekPeriodDate ) , true);

                    for ($week = 0; $week <= 6; $week++) {

                        /* === ORDER REPORT === */
                        $reports[$week] = [
                            'y' => Order::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                            'label' => jddayofweek($week, 1)
                        ];

                        /* === GROSS SALE REPORT === */
                        $grossSaleData[$week] = [
                            'y' => Order::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('amount'),
                            'label' => jddayofweek($week, 1)
                        ];

                        /* === NET SALE REPORT === */
                        $netSaleData[$week] = [
                            'y' => OrderItem::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('sell_price'),
                            'label' => jddayofweek($week, 1)
                        ];

                        /* === ITEM PURCHASED REPORT === */
                        $itemPurchasedData[$week] = [
                            'y' => OrderItem::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                            'label' => jddayofweek($week, 1)
                        ];
                    }
                }elseif($request->sr == 'tm'){

                    /* === TOTAL GROSS SALES === */
                    $grossSale = Order::whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('amount');

                    /* === TOTAL NET SALES === */
                    $netSale = OrderItem::whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('sell_price');

                    /* === TOTAL ORDER PLACED === */
                    $orderPlaced = Order::whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count();

                    /* === ITEMS PURCHASED ===*/
                    $itemPurchased = OrderItem::whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count();

                    /* ===== SALES AND ORDER "BAR CHART" ===== */
                    $date = date('d');
                    if($date > 0){
                        for ($month = 0; $month < $date; $month++) {

                            /* === ORDER REPORT === */
                            $reports[$month] = [
                                'y' => Order::whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                                'label' => ($month+1)
                            ];

                            /* === GROSS SALE REPORT === */
                            $grossSaleData[$month] = [
                                'y' => Order::whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('amount'),
                                'label' => ($month+1)
                            ];

                            /* === NET SALE REPORT === */
                            $netSaleData[$month] = [
                                'y' => OrderItem::whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->sum('sell_price'),
                                'label' => ($month+1)
                            ];

                            /* === ITEM PURCHASED REPORT === */
                            $itemPurchasedData[$month] = [
                                'y' => OrderItem::whereDay('created_at', ($month+1))->whereMonth('created_at', date('m'))->whereYear('created_at', $yearRequest)->count(),
                                'label' => ($month+1)
                            ];
                        }
                    }
                }elseif($request->sr == 'ty'){

                    /* === TOTAL GROSS SALES === */
                    $grossSale = Order::whereYear('created_at', $yearRequest)->sum('amount');

                    /* === TOTAL NET SALES === */
                    $netSale = OrderItem::whereYear('created_at', $yearRequest)->sum('sell_price');

                    /* === TOTAL ORDER PLACED === */
                    $orderPlaced = Order::whereYear('created_at', $yearRequest)->count();

                    /* === ITEMS PURCHASED ===*/
                    $itemPurchased = OrderItem::whereYear('created_at', $yearRequest)->count();

                    /* ===== SALES AND ORDER "BAR CHART" ===== */
                    $currentMonth = date('m');
                    if($currentMonth > 0){
                        for ($year = 0; $year < $currentMonth; $year++) {
                            $month = date("F", mktime(0, 0, 0, ($year+1), 10));

                            /* === ORDER REPORT === */
                            $reports[$year] = [
                                'y' => Order::whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->count(),
                                'label' => $month
                            ];

                            /* === GROSS SALE REPORT === */
                            $grossSaleData[$year] = [
                                'y' => Order::whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->sum('amount'),
                                'label' => $month
                            ];

                            /* === NET SALE REPORT === */
                            $netSaleData[$year] = [
                                'y' => OrderItem::whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->sum('sell_price'),
                                'label' => $month
                            ];

                            /* === ITEM PURCHASED REPORT === */
                            $itemPurchasedData[$year] = [
                                'y' => OrderItem::whereMonth('created_at', ($year+1))->whereYear('created_at', $yearRequest)->count(),
                                'label' => $month
                            ];
                        }
                    }
                }
            }else{
                /* === TOTAL GROSS SALES === */
                $grossSale = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');

                /* === TOTAL NET SALES === */
                $netSale = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('sell_price');

                /* === TOTAL ORDER PLACED === */
                $orderPlaced = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

                /* === ITEMS PURCHASED ===*/
                $itemPurchased = OrderItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

                /* ===== SALES AND ORDER "BAR CHART" ===== */
                $weekPeriodDate = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
                $weekDate = json_decode(json_encode ( $weekPeriodDate ) , true);

                for ($week = 0; $week <= 6; $week++) {

                    /* === ORDER REPORT === */
                    $reports[$week] = [
                        'y' => Order::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
                        'label' => jddayofweek($week, 1)
                    ];

                    /* === GROSS SALE REPORT === */
                    $grossSaleData[$week] = [
                        'y' => Order::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount'),
                        'label' => jddayofweek($week, 1)
                    ];

                    /* === NET SALE REPORT === */
                    $netSaleData[$week] = [
                        'y' => OrderItem::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('sell_price'),
                        'label' => jddayofweek($week, 1)
                    ];

                    /* === ITEM PURCHASED REPORT === */
                    $itemPurchasedData[$week] = [
                        'y' => OrderItem::whereDay('created_at', date('d', strtotime($weekDate[$week])))->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
                        'label' => jddayofweek($week, 1)
                    ];
                }
            }

            return view('backend.report.order-report', compact('grossSale', 'netSale', 'orderPlaced', 'itemPurchased', 'reports', 'grossSaleData', 'netSaleData', 'itemPurchasedData'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return abort(500);
        }
        
    }
    public function analytics(){
        try {
            $customers = User::role('user')->get();
            $last7DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(7))->pluck('amount')->sum();
            $last30DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(30))->pluck('amount')->sum();
            $last365DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(365))->pluck('amount')->sum();
            $customerGuestSale = [];
            $customerSale = [];
            $guestSale = [];

            for ($i = 0; $i < 12; $i++) {
                $orderSale = Order::with('customer')->without(["orderItems","orderCharges"])->whereMonth('created_at', ($i+1))->whereYear('created_at', date('Y'))->get();
                $month = date("F", mktime(0, 0, 0, ($i+1), 10));

                $customerSale[$i] = [
                    'y' => collect($orderSale)->where('customer.type', 'customer')->count(),
                    'label' => $month,
                ];

                $guestSale[$i] = [
                    'y' => collect($orderSale)->where('customer.type', 'guest')->count(),
                    'label' => $month,
                ];
            }

            $customerGuestSale = [
                'customerSale' => $customerSale,
                'guestSale' => $guestSale
            ];

            $activeUser = ['activeUser' => $customers->where('status','1')->count(),'inActiveUser' => $customers->where('status','0')->count()];

            return view('backend.report.analytics', compact('customers','activeUser', 'last7DaysTransaction', 'last30DaysTransaction', 'last365DaysTransaction', 'customerGuestSale'));

        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }

    }
}