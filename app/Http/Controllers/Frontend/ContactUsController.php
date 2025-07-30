<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactUsStoreRequest;
use App\Jobs\{CustomerContactUsJob, CustomerSubscriptionJob};
use App\Models\Subscription;
use Illuminate\Support\Facades\Session;
use Newsletter;
use Spatie\Newsletter\Newsletter as NewsletterNewsletter;

class ContactUsController extends Controller{
    // contact us view page
    // public function create()
    // {
    //     try {
    //     // check session 
    //     orderNumberHelper();
    //         return view('frontend.pages.contact-us.contactus');
    //     } catch (Exception $ex) {
    //         \Log::error($ex);
    //         return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // Contact Us store
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required','email:rfc,dns', 'max:255'],
    //             'description' => 'required',
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'error' => $validator->errors(),
    //             ]);
    //         }
    //         $contactUs = [
    //             'name' => $request['name'],
    //             'email' => $request['email'],
    //             'description' => $request['description'],
    //         ];
    //         $contactUs = ContactUs::create($contactUs);
    //         return response()->json(['status' => 'success', 'message' => 'Sent Successfully !']);
    //     } catch (Exception $ex) {
    //         \Log::error($ex);
    //         return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    //     }
    // }

    // contact us view page
    public function create(){
        try {
            // check session 
            orderNumberHelper();
            return view('frontend.pages.contact-us.contact-us');
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    public function store(ContactUsStoreRequest $request){
        // Contact Us store
        try {
            // Save the contact details to the ContactUs model
            $contactUs = ContactUs::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile_number'),
                'description' => $request->input('description'),
                'subject' => $request->input('subject'),
            ]);
    
            // Send Mail to Customer
            CustomerContactUsJob::dispatch($contactUs);
    
            // Check if the user wants to subscribe to the newsletter
            if ($request->input('newsletter') == 1) {
                $existingSubscription = Subscription::where('email', $request->input('email'))->first();
                
                if ($existingSubscription) {
                    // Update existing subscription if the email already exists
                    $existingSubscription->update(['email' => $request->input('email')]);
                } else {
                    // Create a new subscription if the email doesn't exist
                    Subscription::create(['email' => $request->input('email')]);
                }
    
                // Subscribe the user to the newsletter
                Newsletter::subscribe($request->input('email'), [
                    'FNAME' => $request->input('name'),
                    'LNAME' => $request->input('mobile_number')
                ]);
    
                // Send Mail as CustomerSubscription
                CustomerSubscriptionJob::dispatch($contactUs);
            }
            return response()->json(['status' => 'success', 'message' => 'Thank you for your inquiry!']);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
  
}