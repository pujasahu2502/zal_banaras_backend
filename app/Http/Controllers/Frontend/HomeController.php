<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Brand, Webinar, Category, Product, Testimonial, Listing};

class HomeController extends Controller{
  /**
   * Display a listing of the resource for home page
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    // return auth()->guard('admin')->user();
    try{
      // check session 
      // orderNumberHelper();

      $categories = Category::whereIn('slug',['game-reaper','game-reaper-2','215tactical','freedom-reaper','mounting-accessories','dnz-pro-scope-mounting-kit'])->where('status','1')->get();
      $testimonials = Testimonial::where('status','1')->get();
      // // $homeData = Webinar::where('status','1')->where('type','1')->latest()->take(5)->get();
      // $listingData = Listing::where('status','1')->latest()->take(5)->get();
      // $upcomingWebinar = Webinar::where('status','1')->where('type','0')->latest()->take(5)->get();
      // $homeData = Webinar::select('*', \DB::raw('total_seats - consumed_seats AS remaining_seat'))->with('category')->where('status','1')->where('type','1')->whereRaw('total_seats != consumed_seats')->take(5)->orderBy("remaining_seat")->get();
      $allProducts = Product::with('category', 'productAttribute', 'productVariation')->where("products.status", "1")->where('featured_product','1')->take(6)->get();
      return view('frontend.layouts.home',compact('allProducts','categories','testimonials'));
    }catch (\Exception $ex) {
      \Log::error($ex);
      return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
  }

  /**
   *Product Has Category .
   *
   * @param  string  $slug
   * @return \Illuminate\Http\Response
   */
  public function show($slug){
    try{
      // check session 
      orderNumberHelper();
      $productDetail =   Webinar::with('category')->where('slug', $slug)->first();
      $reletedProduct = Webinar::select('*', \DB::raw('total_seats - consumed_seats AS remaining_seat'))->with('category')->where('status','1')->Where('category_id',$productDetail->category_id)->where('slug', '!=', $slug)->whereRaw('total_seats != consumed_seats')->latest()->take(config('app.paginate'))->get();
      $reletedProductCount = $reletedProduct->count();
      return view('frontend.pages.webinar.webinar-details', compact('productDetail', 'reletedProduct','reletedProductCount'));
    }catch (\Exception $ex) {
    \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
  }

  public function webinar(Request $request){
    try {
      // check session 
      orderNumberHelper();
      $categories = Category::where('status','1')->get();
      $webinarType=isset($request->type) && $request->type =='true' ? '0': '1';
      $webinars = Webinar::select('*', \DB::raw('total_seats - consumed_seats AS remaining_seat'))->with('category')->where('status','1')->where('type',$webinarType)->whereRaw('total_seats != consumed_seats');
      if ($request['category']) {
        $webinars = $webinars->whereIn('category_id',  $request['category']);
      }
      if ($request['category_name']) {
        $categoryName = str_replace('-', ' ', $request['category_name']);
        $webinars = $webinars->with(['category' => function($q) use ($categoryName) {
          $q->where('name', $categoryName);
        }])->whereHas('category', function($q) use ($categoryName) {
            $q->where('name', $categoryName);
        });
      }
      if($request->min && $request->max){
        if($request->min > 0  && $request->max > 0 )
        {
          $webinars = $webinars->whereBetween('price',[$request->min , $request->max]);
        }                   
      }
      if ($request->sort_by  == 'latest') {
        $webinars = $webinars->orderBy('created_at', 'desc');
      }
      if ($request->sort_by  == 'oldest') {
        $webinars = $webinars->orderBy('created_at', 'asc');
      }
      if ($request->sort_by  == 'high_to_low') {
        $webinars = $webinars->orderBy('price', 'desc');
      }
      if ($request->sort_by  == 'low_to_high') {
        $webinars = $webinars->orderBy('price', 'asc');
      }
      $webinars = $webinars->orderBy("remaining_seat")->paginate(config('app.paginate')); 
      $webinarsCount=$webinars->count();   
      if ($request->ajax()) {
        $webinarData = view('frontend.pages.webinar.include-webinar', compact('webinars'));
        $webinarData = $webinarData->render();
        return response()->json(['webinarData' => $webinarData,'webinarsCount' => $webinarsCount]);
      }
      return view('frontend.pages.webinar.webinar', compact('webinars', 'webinarsCount','categories'));
    } catch (\Exception $ex) {
      \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
  }

  public function listing(Request $request)
  {
    try {
      // check session 
      orderNumberHelper();
      $categories = Category::where('status','1')->get();
      $listings = Listing::with('category')->where('status','1');
      if ($request['category']) {
        $listings = $listings->whereIn('category_id',  $request['category']);
      }
      if ($request['category_name']) {
        $categoryName = str_replace('-', ' ', $request['category_name']);
        $listings = $listings->with(['category' => function($q) use ($categoryName) {
          $q->where('name', $categoryName);
        }])->whereHas('category', function($q) use ($categoryName) {
            $q->where('name', $categoryName);
        });
      }
      if ($request->listening_status  == '1') {
        $listings = $listings->where('listening_status', '1');
      }
      if ($request->listening_status  == '0') {
        $listings = $listings->where('listening_status', '0');
      }
      if ($request->listening_status  == '2') {
        $listings = $listings;
      }
      
      if ($request->sort_by  == 'latest') {
        $listings = $listings->orderBy('created_at', 'desc');
      }
      if ($request->sort_by  == 'oldest') {
        $listings = $listings->orderBy('created_at', 'asc');
      }
     
      $listings = $listings->paginate(config('app.paginate')); 
      $listingCount=$listings->count();   
      if ($request->ajax()) {
        $webinarData = view('frontend.pages.listing.include-listing', compact('listings'));
        $webinarData = $webinarData->render();
        return response()->json(['webinarData' => $webinarData,'webinarCount' => $listingCount]);
      }
      
      return view('frontend.pages.listing.listing', compact('listings', 'listingCount','categories'));
    } catch (\Exception $ex) {
      \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
  }

  /**
   *Product Has Category .
   *
   * @param  string  $slug
   * @return \Illuminate\Http\Response
   */
  public function listingDetails($slug)
  {
    try{
      // check session 
      orderNumberHelper();
      $productDetail =   Listing::with('category')->where('slug', $slug)->first();
      $reletedProduct = Webinar::select('*', \DB::raw('total_seats - consumed_seats AS remaining_seat'))->with('category')->where('status','1')->Where('category_id',$productDetail->category_id)->where('slug', '!=', $slug)->whereRaw('total_seats != consumed_seats')->latest()->take(config('app.paginate'))->get();
      $reletedProductCount = $reletedProduct->count();
      return view('frontend/pages/listing/listing-details', compact('productDetail', 'reletedProduct','reletedProductCount'));
    }catch (\Exception $ex) {
    \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
  }
   
  }
  
}