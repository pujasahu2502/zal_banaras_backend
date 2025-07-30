<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
      try{
        $blogs = Blog::where('status', '1')->get();
        return view('frontend/pages/blog/blog',compact('blogs'));
      }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
      }
    }

    public function blogDetails($slug)
    {
      try{
        $blog = Blog::where('slug', $slug)->first();
        $relatedblogs = Blog::where('slug','!=',$slug)->take(6)->get();
        return view('frontend.pages.blog.blog-detail',compact('blog','relatedblogs'));
      }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
      }
    }
}
