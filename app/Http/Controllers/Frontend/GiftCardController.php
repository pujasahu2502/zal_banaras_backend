<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\AssignGiftCard;

class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        // check session 
        orderNumberHelper();
            $assignGiftCard = AssignGiftCard::with('webinar','giftCard')->where('user_id', Auth()->id())->paginate(config('app.paginate'));
            return view('frontend.pages.dashboard.include.gift-card-list', compact('assignGiftCard'));
        }catch (Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }    
}
