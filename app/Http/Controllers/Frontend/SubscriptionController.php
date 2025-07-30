<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Jobs\CustomerSubscriptionJob;
// use Spatie\Newsletter\Facades\Newsletter;
use Newsletter;

class SubscriptionController extends Controller{



    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required','email','email:rfc,dns', 'max:40', 'unique:subscription'],
            ]);
            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }
            $subscription = [
                'email' => $request['email'],
            ];
            $subscription = Subscription::create($subscription);
            /* === Send Mail to Customer === */
            Newsletter::subscribe($request['email'], ['FNAME' => ' ', 'LNAME' => ' ']);
            CustomerSubscriptionJob::dispatch($subscription);
            return response()->json(['status' => 'success', 'message' => 'Thank you for subscribing!']);
        } catch (Exception $ex) {
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}