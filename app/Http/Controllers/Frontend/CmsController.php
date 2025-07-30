<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use App\Models\{Faq,Page};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function faq(){
        // check session 
        orderNumberHelper();
        $faqs = Faq::where('status','1')->get();
        return view('frontend.pages.faq',compact('faqs')); 
    }

    public function aboutUs(){
        // check session 
        orderNumberHelper();
        $about = Page::where('slug','about-us')->first();
        if($about['status']) {
            return view('frontend.pages.about-us',compact('about')); 
        }
       abort('404');
    }

    public function privacyAndPolicy(){
        // check session 
        orderNumberHelper();
        $privacy = Page::where('slug','privacy-policy')->first();
        if($privacy['status']) {
            return view('frontend.pages.privacy-policy',compact('privacy'));
        }
        abort('404');
    }

    public function sweepsTakes(){
        // check session 
        orderNumberHelper();
        $sweepTakes = Page::where('slug','sweepstakes-rules')->first();
        if($sweepTakes['status']) {
            return view('frontend.pages.sweepstakes-rules',compact('sweepTakes'));
        }
        abort('404');
    }

    public function termAndCondition(){
        // check session 
        orderNumberHelper();
        $terms = Page::where('slug','terms-&-conditions')->first();
        if($terms['status']) {
            return view('frontend.pages.terms-and-condition',compact('terms'));
        }
        abort('404');
    }

}
