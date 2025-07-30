<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ContactUs, Subscription};

class ContactUsController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){
        $this->middleware('permission:list-contact-us', [ 'only' => ['index'] ]);
        $this->middleware('permission:show-contact-us', [ 'only' => ['show'] ]);
        $this->middleware('permission:list-subscription', [ 'only' => ['subscriptionList'] ]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $contactUsData = ContactUs::query();
            $flag ='';
            /* === FILTER SHORT BY === */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $contactUsData = $contactUsData->oldest();
                }elseif($sortBy == '2'){
                    $contactUsData = $contactUsData->latest();
                }elseif($sortBy == '3'){
                    $contactUsData = $contactUsData->orderBy('name','ASC');
                }elseif($sortBy == '4'){
                    $contactUsData = $contactUsData->orderBy('name','DESC');
                }else{

                }
            }
            $contactUsData = $contactUsData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.enquiry.index', compact('contactUsData', 'flag'));
        } catch (Exception $ex) {
            \Log::error($ex);return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id){
        try {
            $contactUs = ContactUs::find($id);
            $contactUsModel = view('backend.enquiry.include.detail',compact('contactUs'))->render();
            return response()->json([ 'status' => 'success', 'output' => $contactUsModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
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
            $flag ='';
            $enquiryData = ContactUs::find($id);
            $enquiryData->delete();
            $contactUsData = ContactUs::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $categoryTable = view(
                'backend.enquiry.include.enquiry-table',compact('contactUsData', 'flag'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Enquiry deleted successfully!', 'output' => $categoryTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* =============== CUSTOMER SUBSCRIPTION LIST =============== */
    public function subscriptionList(Request $request){
        try {
            $subscriptions = Subscription::query();
            $flag ='';
            /* === FILTER SHORT BY === */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $subscriptions = $subscriptions->oldest();
                }elseif($sortBy == '2'){
                    $subscriptions = $subscriptions->latest();
                }else{

                }
            }
            $subscriptions = $subscriptions->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            return view('backend.subscription.subscription',compact('subscriptions', 'flag'));
        } catch (Exception $ex) {
            \Log::error($ex);return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}