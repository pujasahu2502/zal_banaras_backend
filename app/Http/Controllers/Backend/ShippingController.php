<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Shipping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{ShippingStoreRequest, ShippingUpdateRequest};

class ShippingController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Shipping $shipping){
        $flag = '';
        $shippings = $shipping->latest();
        /* === SEARCH ZONE NAME, STATE === */
        if (isset($request->search) && (!empty($request->search))) {
            $flag = 1 ;
            $shippings = $shippings
                ->where('zone_name', 'like', '%' . $request->search . '%')
                ->orWhere('state', 'like', '%' . $request->search . '%');
        }
        /* === FILTER SHIPPING STATUS === */
        if($request->ss != null){
            $flag = 1 ;
            if($request->ss == '1'){
                $shippings = $shippings->where('status', $request->ss);
            }elseif($request->ss == '0'){
                $shippings = $shippings->where('status', $request->ss);
            }else{

            }
        }
         $shippings = $shippings->orderBy('id', 'DESC')->get()->groupBy('zone_name');
        $page = config('app.paginate') ;
        $shippings = paginate($shippings,$page,request()->query()); //->setPath(request()->query());
        return view('backend.shipping.index', compact('shippings','flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $output = view("backend.shipping.create")->render();
        return response()->json(['status' => 'success', 'output' => $output]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingStoreRequest $request, Shipping $shipping){

        foreach(json_decode($request["states"]) as $state) {
            $shippingData = [
                'zone_name'=> $request->zone_name ? $request->zone_name : 'US',
                'state' => $state, 
                'fixed_amount' => $request->amount, 
                'status' => $request->status
            ];
            $shipping->create($shippingData);
        }
        $shippings = $shipping->orderBy('id', 'DESC')->get()->groupBy('zone_name');
        $page = config('app.paginate') ;
        $shippings = paginate($shippings,$page,request()->query()); 
        $output = view("backend.shipping.include.list", compact('shippings'))->render();
        return response()->json([ "status" => "success", "message"=>"Shipping added successfully!", "output" => $output ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug){
        $shipping = Shipping::where('zone_name',str_replace('-'," ",$slug))->get();
        $output = view("backend.shipping.create",compact('shipping'))->render();
        return response()->json(["status" => "success", "output" =>   $output]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingUpdateRequest $request, $slug){

        Shipping::where('zone_name',$request->zone_name)->delete();
        foreach(json_decode($request["states"]) as $state) {
            $shippingData = [
                'zone_name'=> $request->zone_name ? $request->zone_name : 'US',
                'state' => $state, 
                'fixed_amount' => $request->amount, 
                'status' => $request->status
            ];
            Shipping::create($shippingData);
        }
        $shippings = Shipping::orderBy('id', 'DESC')->get()->groupBy('zone_name');
        $page = config('app.paginate') ;
        $shippings = paginate($shippings,$page,request()->query()); 

        $output = view("backend.shipping.include.list", compact('shippings'))->render();

        return response()->json([ 'status'=>'success', "message"=>"Shipping updated successfully!", 'output'=>$output ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug){
        // return $id;
        $shipping = Shipping::where('zone_name',str_replace('-'," ",$slug))->get();
        if ( $shipping->count() > 0) {
            $shipping->each->delete();
            $flag = '' ;
            $shippings = Shipping::orderBy('id', 'DESC')->get()->groupBy('zone_name');
            $page = config('app.paginate') ;
            $shippings = paginate($shippings,$page,request()->query());            
            $output = view("backend.shipping.include.list", compact('shippings','flag'))->render();
            return response()->json(["status" => "success", "message" => "Shipping deleted successfully!", "output" => $output]);
        } else {
            return response()->json(["status" => "error", "message" => "Something went wrong please try again."]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shippingStatus($slug){
        try {
            // return $slug;
            $ids =Shipping::where('zone_name',str_replace('-'," ",$slug))->pluck("id");
            $status = Shipping::where('id', $ids[0])->first()->status;
            $shipping['status'] = $status ? '0' : '1';
            // $shipping['id'] = $id;
            Shipping::whereIn('id',$ids)->update([ 'status' => $shipping['status']]);
            $shipping = Shipping::where('zone_name',str_replace('-'," ",$slug))->get();
            $shippingStatus = view('backend.shipping.include.status', compact('shipping'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $shippingStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}