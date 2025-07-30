<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class WhydnzController extends Controller
{
    public function index()
    {
      try{
        $productInfo = Category::where('description','!=',' ')->select('id','slug','name','description')->get();       
        return view('frontend.pages.why-dnz.why-dnz',compact('productInfo'));
      }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
      }
    }
}
