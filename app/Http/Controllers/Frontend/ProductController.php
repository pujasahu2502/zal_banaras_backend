<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ Product, Category, Variation, SeoAnalysis,Review,Brand, ProductCategories };

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // return $request;
            $allCategory = Category::select("id", "slug", "name", "status")->where('status', "1")->withCount("productCategoryActive")->orderBy('product_category_active_count','DESC')->get();
            $allBrand = Brand::select("id", "slug", "name", "status")->where('status', "1")->withCount("product")->orderBy('product_count','DESC')->get();
            $allProducts = Product::with('category', 'productAttribute', 'productVariation')->where("products.status", "1");
            $featureProduct=Product::select("id", "slug", "name", "status")->where("featured_product", "1")->get();
            // $allAttribute = Attribute::select('id', 'slug', 'name', 'status')->where("status", "1")->with('activeVariations')->get();
            if ($request['category']) {
                // return $request['category'];
                $categories = Category::whereIn("slug",$request['category'])->pluck('id')->toArray();
                $allProducts = $allProducts->whereRelation('productCategory', function ($query) use ($categories) {
                    $query->whereIn('category_id', $categories);
                });
            }

            if ($request['brand']) {
                $brands = $request['brand'];
                $brands = Brand::whereIn("slug",$brands)->pluck('id')->toArray();
                $allProducts = $allProducts->whereRelation('brand', function ($query) use ($brands) {
                    $query->whereIn('id', $brands);
                });
            }

            if (is_array($request['rating'])) {
                $allProducts = $allProducts->where('avg_rating','>=',$request['rating'][count($request['rating'])-1]);
            }

            /*  ====================Note===================
            **  For Attribute Filter
            **  Don't Remove 
            *   ============================================
            */
            // foreach ($allAttribute as $attributeKey => $attribute) {
            //     $attributeSlug = str_replace("-","_",$attribute["slug"]);
            //     if($request->has($attributeSlug)) {
            //         $attributesVariant = $request[$attributeSlug];
            //         $variant = Variation::whereIn('slug',$attributesVariant)->pluck('id');
            //         $allProducts = $allProducts->whereRelation('productAttribute.totalVariation',function($query) use ($variant) {
            //                $query->whereIn('id', $variant);
            //         });
            //     }
            // }
            
            if ($request['search']) {
                $allProducts = $allProducts->where('name', 'like', '%' . $request['search']  . '%');  
            }
                
            if ($request['featProduct']) {
                $allProducts = $allProducts->where('featured_product', '1');  
            }

              $allProducts = $allProducts->orderBy('id', ($request['sort'] == "old" ?  "ASC" : 'DESC'))->paginate($request["paginate"] ? $request["paginate"] : config('app.paginate'))->appends(request()->query());
              return view('frontend.pages.product.index', compact('allProducts', 'allCategory','allBrand','featureProduct'));
        } catch (Exception $ex) {
            \Log::error($ex);
            dd($ex);
            abort(500);
        }
    }

    /**
     * Display product detail page
     *  
     *  @return \Illuminate\Http\Response
     */
    public function singleProduct($slug)
    { 
 
        $product = Product::with('category','productCategory','productVariation', 'productAttribute')->withCount('reviews')->where('slug', $slug)->first();
        if(!$product){
            abort(404);
        }        
        $variation = $product->productVariation()->get();
        $filterStatus =  $this->checkFilterStatus($variation);
        $variationId = $product->productVariation()->where('status','1')->where('stock_status','!=','Out of stock')->pluck('variation_id');
        $variationArr = [];
        $highestVariationCount = 0;
        if(count($variationId)) {
            foreach ($variationId as $variation) {
                if(is_array( $variation)) {
                    if($highestVariationCount < count($variation)  ){
                        $highestVariationCount = count($variation);
                    }
                    foreach ($variation as $variation1) {
                        if(in_array($variation1,$variationArr) == 0 &&  count($variation) == $highestVariationCount )
                            $variationArr[] = $variation1;
                    }
                }else{
                    $variationArr[] = $variation;
                }
            }
        }

        $producAttributeData =  $product->productAttribute()->orderBy('priority','ASC')->get()->groupBy('attribute.slug');
        $sorting = array_keys($producAttributeData->toArray());

        $variationList1 =  Variation::select('id','attribute_id','name','slug','status')->whereIn('id',$variationArr)->with('attribute')->get()->groupBy('allAttribute.slug')->sortKeys();

        $variationList = $variationList1->sortBy(function($model) use ($sorting) {
            // dd(collect($model)->first()->attribute->slug);
            return array_search(collect($model)->first()->attribute->slug, $sorting);
        });
        
       
        // if(Auth::check()){
        //     $userReview = Review::where(['user_id' => auth()->user()->id,'product_id' => $product->id])->first();
        //     $reviews = Review::where('user_id', "!=", auth()->user()->id)->where('status', '1')->where('product_id', $product->id)->get();
        //     $allReviews = Review::where('status', '1')->where('product_id', $product->id)->get();
        // }
        // else{
            $userReview = null;
            $reviews = Review::where('status', '1')->where('product_id', $product->id)->get();
            $allReviews = Review::where('status', '1')->where('product_id', $product->id)->get();
        // }
        $relatedProducts = Product::with('category')->where('category_id', $product->category_id)->where('category_id', '!=' , 426)->where('id', '!=', $product->id)->where('status', '1')->orderBy('id', 'DESC')->get();
        // get meta data of a product
        $metaProductData = SeoAnalysis::where([['from_id', '=', $product->id], ['from', '=', 'Product']])->first();
        return view('frontend.pages.product.single-product', compact('product', 'relatedProducts', 'metaProductData','reviews','userReview','allReviews', 'variationList','filterStatus'));
    }

    public function addReview(Request $request)
    {
        try{
            if($request->ajax()){

                if(Auth::check()){
                    $product = Product::where('slug', $request->slug)->first();
                    if($product){
                        Review::create(
                            [
                                'user_id' => auth()->user()->id,
                                'product_id' => $product->id,
                                'rating' => $request->rating,
                                'review' => (!empty($request->message)) ? $request->message : NULL,
                                'status' => '0'
                            ]
                        );
    
                        $userReview = Review::where([
                            'user_id' => auth()->user()->id,
                            'product_id' => $product->id
                        ])->first();
    
                        $reviews = Review::where('user_id', "!=", auth()->user()->id)
                            ->where('status', '1')
                            ->where('product_id', $product->id)->get();
    
                        $returnHTML = view('frontend.pages.product.include.reviews',compact('product','reviews','userReview'))->render();
    
                        return response()->json(['status' => 'success', 'message' => 'Product review submitted successfully.'
                        ,'data'=>$returnHTML]);
                    }
                    return response()->json(['status' => 'error', 'message' => 'Product not found.']);
                }
                return response()->json(['status' => 'error', 'message' => 'Please login to add review.']);
            }
            abort(403);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
        
    }


    public function clearFilter($slug)
    {
        $product = Product::with('category', 'productVariation', 'productAttribute')->where('slug', $slug)->first();
        if(!$product){
            return response()->json(["status" => "error", "url" => route('home')]);
        }
        $variationId = $product->productVariation()->where('status','1')->pluck('variation_id');

        $variationArr = [];
        $highestVariationCount = 0;

        foreach ($variationId as $variation) {
            if($highestVariationCount < count($variation)  ){
                $highestVariationCount = count($variation);
            }
            foreach ($variation as $variation1) {
                if(in_array($variation1,$variationArr) == 0 &&  count($variation) == $highestVariationCount )
                    $variationArr[] = $variation1;
            }
        }

        $variationList =  Variation::select('id','attribute_id','name','slug','status')->whereIn('id',$variationArr)->with('attribute')->get()->groupBy('allAttribute.slug')->sortKeys();

        $filterStatus = false;
        $filterOutput = view('frontend.pages.product.include.variation-filter',compact('variationList','slug','filterStatus'))->render();
        return response()->json(["status" => "success", "output" => $filterOutput]);
    }

    public function temp()
    {
      $allProduct = Product::with('category', 'productVariation', 'productAttribute')->where('type','2')->get();
      foreach($allProduct as $product){
        $productVariations = $product->productVariation()->get();
        foreach($productVariations as $variation){
            $variation->update(['variation_id'=>\json_decode($variation->variation_id)]);
        }
      }
      return 'success';
    }

    public function Categorytemp()
    {
        $products = Product::get();
        ProductCategories::truncate();

        foreach($products as $product){
            $product = ProductCategories::Create([
                "product_id" => $product['id'],
                "category_id"=> $product["category_id"]
            ]);
        }
        return 'success';
    }

    public function checkFilterStatus($productVariations)
    {
        foreach($productVariations as $variations) {
            foreach ($variations['variation'] as $key => $value) {
                if($value['attribute'] == null){
                    return 'hideFilter';
                }
            }
        }
        return 'showFilter';
    }
}
