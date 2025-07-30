<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\{Coupon, Product, Category};

class CouponController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){

    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $flag ='';
            $couponData = Coupon::latest();
            /* === SEARCH COUPON CODE === */
            if($request->search && $request->search != null){
                $flag =1;
                $couponData = $couponData
                    ->where('code', 'like', '%' . $request->search . '%');
            }
            /* === FILTER COUPON STATUS === */
            if($request->ss != null){
                $flag =1;
                if($request->ss == '1'){
                    $couponData = $couponData->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $couponData = $couponData->where('status', $request->ss);
                }else{

                }
            }
            /* === FILTER VIA COUPON TYPE === */
            if($request->st != null){
                $flag =1;
                if($request->st == '1'){
                    $couponData = $couponData->where('type', $request->st);
                }elseif($request->st == '2'){
                    $couponData = $couponData->where('type', $request->st);
                }elseif($request->st == '3'){
                    $couponData = $couponData->where('type', $request->st);
                }else{

                }
            }
            $couponData = $couponData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.coupon.index', compact('couponData','flag'));
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        try {
            $allProduct = Product::where('type','1')->where('status', '1')->orderBy('name', 'ASC')->select('id','name')->get();
            $couponModel = view('backend.coupon.include.add-coupon',compact('allProduct'))->render();
            return response()->json([ 'status' => 'success', 'output' => $couponModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
         
            $validator = Validator::make(
                $request->all(),
                [
                    'code'      => ['required', 'string', 'max:15', 'unique:coupons,code'],
                    'type'      => 'required',
                    'amount'    => 'required_if:type,==,1 && 2',
                    'apply_on'  => 'required',
                    // 'product_id'  => 'required',
                    'start_date'=> 'required|date',
                    'end_date'  => 'required|date|after_or_equal:start_date',
                ],
                [
                    'code.required' => 'The coupon code field is required.',
                    // 'end_date.after_or_equal' => 'The end date must be a date after to start date.',
                    'end_date.after_or_equal' => 'End date should be after the start date.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status'=>'error', 'error'=>$validator->errors() ]);
            }
            $coupon = [
                'code'        => $request['code'],
                'amount'      => $request['amount'] != null ? $request['amount'] : null,
                'type'        => $request['type'],
                'apply_on'    => $request['apply_on'],
                'description' => $request['description'],
                'product_id'  => $request['product_id'],
                'usage_limit' => $request['usage_limit'] != null ? $request['usage_limit'] : null,
                'start_date'  => $request['start_date'],
                'end_date'    => $request['end_date'],
                'status'      => $request['status'],
            ];
            $coupon = Coupon::create($coupon);
            if(isset($request->apply_on_value) && $request->apply_on_value != []){
                foreach($request->apply_on_value as $applyVal){
                    $coupon->couponApply()->create(['apply_on_value' => $applyVal]);
                }
            }
            $couponData = Coupon::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $couponTable = view('backend.coupon.include.coupon-table', compact('couponData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Coupon added successfully!', 'output' => $couponTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id){
        try {
            $coupon = Coupon::with('couponApply')->find($id);
            $allProduct = Product::where('status', '1')->orderBy('id', 'DESC')->get();
            $allCategory = Category::where('status', '1')->orderBy('id', 'DESC')->get();
            $couponModel = view('backend.coupon.include.edit-coupon', compact('coupon', 'allProduct', 'allCategory'))->render();
            return response()->json([ 'status' => 'success', 'output' => $couponModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'code'      => ['required', 'string', 'max:15', 'unique:coupons,code,' .$id],
                    'type'      => 'required',
                    'amount'    => 'required_if:type,==,1 && 2',
                    'apply_on'  => 'required',
                    // 'product_id'  => 'required',
                    'start_date'=> 'required|date',
                    'end_date'  => 'required|date|after_or_equal:start_date',
                ],
                [
                    'code.required' => 'The coupon code field is required.',
                    // 'end_date.after_or_equal' => 'The end date must be a date after to start date.',
                    'end_date.after_or_equal' => 'End date should be after the start date.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status'=>'error', 'error'=>$validator->errors() ]);
            }

            $data = [
                'code'        => $request['code'],
                'amount'      => $request['amount'] != null ? $request['amount'] : null,
                'type'        => $request['type'],
                'apply_on'    => $request['apply_on'],
                'description' => $request['description'],
                'product_id'  => $request['product_id'],
                'usage_limit' => $request['usage_limit'] != null ? $request['usage_limit'] : null,
                'start_date'  => $request['start_date'],
                'end_date'    => $request['end_date'],
                'status'      => $request['status'],
            ];

            $coupon = Coupon::find($id);
            if ($coupon) {
                $coupon->update($data);
            }

            $coupon->couponApply()->delete();
            if(isset($request->apply_on_value) && $request->apply_on_value != []){
                foreach($request->apply_on_value as $applyVal){
                    $coupon->couponApply()->create(['apply_on_value' => $applyVal]);
                }
            }

            $couponData = Coupon::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $couponTable = view('backend.coupon.include.coupon-table', compact('couponData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Coupon updated successfully!', 'output' => $couponTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* ===== COUPON STATUS ===== */
    public function couponStatus($id){
        try {
            $status = Coupon::where('id', $id)->first()->status;
            $coupon['status'] = $status ? '0' : '1';
            $coupon['id'] = $id;
            Coupon::where('id', $id)->update([ 'status' => $coupon['status'] ]);
            $couponStatus = view('backend.coupon.include.status', compact('coupon'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $couponStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* ===== COUPON APPLY ON ===== */
    public function couponApplyOn(Request $request){
        try {
            $data = [];
            $applied = '';
            if($request->applyOn == '2'){
                $data = Product::where('status', '1')->orderBy('name', 'ASC')->get();
                $applied = 'Product';
            }else if($request->applyOn == '3'){
                $data = Category::where('status', '1')->orderBy('name', 'ASC')->get();
                $applied = 'Category';
            }else{
                $data = [];
                $applied = '';
            }
            $couponApplyOn = view('backend.coupon.include.applyon', compact('data', 'applied'))->render();
            return response()->json([ 'status' => 'success', 'output' => $couponApplyOn, 'applied' => $applied ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}