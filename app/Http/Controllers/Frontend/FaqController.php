<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $faqData = Faq::where('status','1')->where('faq_category','!=',"FAQ's")->get()->groupBy('faq_category')->toArray();
            return view('frontend.pages.faq.faq-video', compact('faqData'));
        }catch (\Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
    
    public function faqInfo(){
        try{
            $faqData = Faq::where('status','1')->where('faq_category',"FAQ's")->get()->groupBy('faq_category')->toArray();
            return view('frontend.pages.faq.faq-info', compact('faqData'));
        }catch (\Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}