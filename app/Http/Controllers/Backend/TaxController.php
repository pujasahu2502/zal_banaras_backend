<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\{TaxRequest, TaxUpdateRequest};

class TaxController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,Tax $tax){
        try {
            $flag = '';
            $taxes = $tax->latest();
            /* === SEARCH TAX NAME, STATE NAME === */
            if($request->search && $request->search != null){
                $flag = 1;
                $taxes = $taxes
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('state', 'like', '%' . $request->search . '%');
            }
            /* === FILTER TAX STATUS === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $taxes = $taxes->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $taxes = $taxes->where('status', $request->ss);
                }else{

                }
            }
            $taxes = $taxes->orderBy('id', 'DESC')->get()->groupBy('name');
            $page = config('app.paginate');
            $taxes = paginate($taxes,$page,request()->query()); 
            return view('backend.tax.index',compact('taxes','flag'));
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
            $output = view("backend.tax.create")->render();
            return response()->json(['status' => 'success', 'output' => $output]);
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
    public function store(TaxRequest $request,Tax $tax){
        foreach(json_decode($request["states"]) as $state) {
            $data = [
                'name'=> $request['name'],
                'tax' => $request['tax_percent'], 
                'state' => $state, 
                'status' => $request["status"]
            ];
            $tax->create($data);
        }
        $taxes = $tax->orderBy('id', 'DESC')->get()->groupBy('name');
        $page = config('app.paginate');
        $taxes = paginate($taxes,$page,request()->query()); 
        $output = view("backend.tax.include.tax-table", compact('taxes'))->render();
        return response()->json([ "status" => "success", "message"=>"Tax added successfully!", "output" => $output ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug){
        $tax = Tax::where('name',str_replace('-'," ",$slug))->get();
        $output = view("backend.tax.create", compact('tax'))->render();
        return response()->json([ "status" => "success", "output" => $output ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaxUpdateRequest $request,$slug){
        Tax::where('name',$request->name)->delete();
        foreach(json_decode($request["states"]) as $state) {
            $data = [
                'name'=> $request['name'],
                'tax' => $request['tax_percent'], 
                'state' => $state, 
                'status' => $request["status"]
            ];
            Tax::create($data);
        }
        $taxes = Tax::orderBy('id', 'DESC')->get()->groupBy('name');
        $page = config('app.paginate');
        $taxes = paginate($taxes,$page,request()->query()); 
        $output = view("backend.tax.include.tax-table", compact('taxes'))->render();
        return response()->json([ "status" => "success", "message"=>"Tax updated successfully!", "output" => $output ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
      */

    public function destroy($slug){
        // return $id;
        $tax = Tax::where('name',str_replace('-'," ",$slug))->get();
        if ( $tax->count() > 0) {
            $tax->each->delete();
            $flag = '' ;
            $taxes = Tax::orderBy('id', 'DESC')->get()->groupBy('name');
            $page = config('app.paginate');
            $taxes = paginate($taxes,$page,request()->query()); 
            $output = view("backend.tax.include.tax-table", compact('taxes'))->render();
            return response()->json(["status" => "success", "message" => "Tax deleted successfully!", "output" => $output]);
        } else {
            return response()->json(["status" => "error", "message" => "Something went wrong please try again."]);
        }
    }

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function taxStatus($slug){
        try {
            // return $slug;
            $ids =Tax::where('name',str_replace('-'," ",$slug))->pluck("id");
            $status = Tax::where('id', $ids[0])->first()->status;
            $tax['status'] = $status ? '0' : '1';
            // $shipping['id'] = $id;
            Tax::whereIn('id',$ids)->update([ 'status' => $tax['status']]);
            $tax = Tax::where('name',str_replace('-'," ",$slug))->get();
            $taxStatus = view('backend.tax.include.status', compact('tax'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $taxStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}