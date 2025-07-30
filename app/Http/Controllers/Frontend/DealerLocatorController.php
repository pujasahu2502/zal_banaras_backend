<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Dealer, DealerAddress};

class DealerLocatorController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       
    //    return $request;
        try {
            $dealer = Dealer::with('address');

            if (isset($request->locationSearch) && (!empty($request->locationSearch))) {
                $search = $request->locationSearch;
                $dealer = $dealer
                ->where('title', 'like', '%' . $search . '%')
                ->orWhereRelation('address', 'address', 'like', '%' . $search . '%');
                // ->with(['address' => function( $query ) use ($search) {
                //     $query->orWhere('address', 'like', '%' . $search . '%');
                //     $query->orWhere('zip', 'like', '%' . $search . '%');
                //     $query->orWhere('city', 'like', '%' . $search . '%');
                // }])
                // ->WhereHas('address', function( $query ) use ($search) {
                //     $query->orWhere('address', 'like', '%' . $search . '%');
                //     $query->orWhere('zip', 'like', '%' . $search . '%');
                //     $query->orWhere('city', 'like', '%' . $search . '%');
                // });
            }

            $dealerData = $dealer->where('status','1')->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $search =  $request->locationSearch ?? '';

            //location 
            $locations = [];
            if (!$dealerData->isEmpty()) {
                foreach( $dealerData as $key => $val) {
                    $data = [
                        "title" => $val->title,
                        'phone' =>  $val->phone ?? '---',
                        'email' =>  $val->email ?? '---',
                        'web_url' => $val->website_url,
                        "lat" => $val['address']->latitude, 
                        "lng" => $val['address']->longitude,
                        "address" => $val['address']->address.'. '.$val['address']->zip.'.',
                    ];
                    array_push($locations, $data);
                }
            }else{
                $locations = [[
                    "title" => 'DNZ Products',
                    'phone' => '9197779608',
                    'email' => 'certified@windstream.net',
                    'web_url' => 'https://www.dnzproducts.com',
                    "lat" => '35.50388', 
                    "lng" => '-79.20489',
                    "address" => '2710 Wilkins Dr, Sanford, NC 27330, USA',
                ]];
            }
            return view('frontend.pages.dealer-locator.index', compact('dealerData', 'search', 'locations'));

        } catch (Exception $ex) {
            \Log::error($ex);
            return abort(500);
        }
    }   
}