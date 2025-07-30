<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{User, Address};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller{
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
        try{
            $addressData = Address::where('user_id', auth()->guard('web')->id())->where('type','customer')->orderBy("default_address","Desc")->get();
            return view('frontend.pages.dashboard.include.address.index',compact('addressData'));            
        }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        try {
            $addressData = Address::where('user_id', auth()->guard('web')->id())->get();
            return view('frontend.pages.dashboard.include.address.index',compact('addressData'));
            // return view('frontend.pages.dashboard.include.address.index');
            //return response()->json([ 'status' => 'success', 'output' => $addressView ]);
        } catch (\Exception $ex) {
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
            $validate = Validator::make(
                $request->all(),
                [
                    'first_name'    => [ 'required', 'string', 'max:30' ],
                    'last_name'     => [ 'required', 'string', 'max:30' ],
                    'email'         => [ 'required', 'string', 'email:rfc,dns', 'max:60' ],
                    'mobile_number' => [ 'required', 'numeric' ],
                    'address'       => [ 'required', 'max:100' ],
                    'state'         => [ 'required' ],
                    'city'          => [ 'required', 'max:30' ],
                    'zipcode'       => [ 'required', 'max:6' ],
                ]
            );

            if($validate->fails()){
                return response()->json([ 'status' => "error" , "errors" => $validate->errors()]);
            }

            $data = [
                'user_id'    => auth()->guard('web')->id(),
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'mobile'     => $request->mobile_number,
                'address'    => $request->address,
                'state'      => $request->state,
                'city'       => $request->city,
                'zipcode'    => $request->zipcode,
                'type'       => 'customer',
            ];

            $addressAdd = Address::create($data);

            /* === Default Address === */
            if($request->default_address != null){
                Address::where('user_id', auth()->guard('web')->id())->update(['default_address' => '0']);
                Address::where('id', $addressAdd->id)->update(['default_address' => '1']);
            }

            \Session::flash('success', 'Address added successfully!');
            // return redirect()->route('address.index');
            return response()->json(['status' => 'success', 'message' => 'Address added successfully!']);
        } catch (\Exception $ex) {
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
            $addressData = Address::where('user_id', auth()->guard('web')->id())->get();
            $address = Address::where('user_id', auth()->guard('web')->id())->find($id);
            return view('frontend.pages.dashboard.include.address.index',compact('addressData','address'));
        } catch (\Exception $ex) {
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
            $validate = Validator::make(
                $request->all(),
                [
                    'first_name'    => [ 'required', 'string', 'max:30' ],
                    'last_name'     => [ 'required', 'string', 'max:30' ],
                    'email'         => [ 'required', 'string', 'email:rfc,dns', 'max:40' ],
                    'mobile_number' => [ 'required', 'numeric' ],
                    'address'       => [ 'required', 'max:100' ],
                    'state'         => [ 'required' ],
                    'city'          => [ 'required', 'max:30' ],
                    'zipcode'       => [ 'required', 'max:6' ],
                ]
            );

            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }

            $data = [
                'user_id'    => Auth()->id(),
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'mobile'     => $request->mobile_number,
                'address'    => $request->address,
                'state'      => $request->state,
                'city'       => $request->city,
                'zipcode'    => $request->zipcode,
            ];
            $address = Address::find($id);
            if ($address) {
                $address->update($data);
                /* === Default Address === */
                Address::where('user_id', auth()->guard('web')->id())->update(['default_address' => '0']);
                if($request->default_address != null){
                    $address->update(['default_address' => '1']);
                }
            }
            \Session::flash('success', 'Address updated successfully!');
            // return redirect()->route('address.index');
            return response()->json(['status' => 'success', 'message' => 'Address updated successfully!']);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id){
        try {
           
            $addressData = Address::find($id);
            $addressData->delete();
            $addressCount = Address::where('user_id', auth()->guard('web')->id())->count();
            $addressData = Address::where('user_id', auth()->guard('web')->id())->where('type','customer')->get();
            $addressTable = view('frontend.pages.dashboard.include.address.include.address-table', compact('addressData'))->render();
            return response()->json([ 'status' => 'success', 'message' => ' deleted successfully!','addressData' => $addressTable, 'output' => $addressCount ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}