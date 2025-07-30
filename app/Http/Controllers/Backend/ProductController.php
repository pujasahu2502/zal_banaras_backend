<?php
namespace App\Http\Controllers\Backend;

use URL;
use PDO;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\{Product, Category, ProductCategories, Attribute, ProductAttribute, ProductVariation, SeoAnalysis, Brand, OrderItem};
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){
        $this->middleware('permission:list-product', ['only' => ['index']]);
        $this->middleware('permission:create-product', ['only' => ['create']]);
        $this->middleware('permission:store-product', ['only' => ['store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit']]);
        $this->middleware('permission:update-product', ['only' => ['update']]);
        $this->middleware('permission:destroy-product', ['only' => ['destroy'],]);
        $this->middleware('permission:productStatus-product', ['only' => ['productStatus'],]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try{
            
            $flag = '';
            $productData = Product::with('category','productCategory');
            /* === FILTER SHORT BY=== */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $productData = $productData->oldest();
                }elseif($sortBy == '2'){
                    $productData = $productData->latest();
                }elseif($sortBy == '3'){
                    $productData = $productData->orderBy('name','ASC');
                }elseif($sortBy == '4'){
                    $productData = $productData->orderBy('name','DESC');
                }else{

                }
            }
           
            /* === FILTER VIA PRODUCT STATUS === */
            if($request->ps != null){
                $flag = 1;
                if($request->ps == '1'){
                    $productData = $productData->where('status', $request->ps);
                }elseif($request->ps == '2'){
                    $productData = $productData->where('status', $request->ps);
                }elseif($request->ps == '0'){
                    $productData = $productData->where('status', $request->ps);
                }
            }
            /* === FILTER PRODUCT TYPE === */
            if($request->pt != null){
                $flag = 1;
                if($request->pt == '1'){
                    $productData = $productData->where('type', $request->pt);
                }elseif($request->pt == '2'){
                    $productData = $productData->where('type', $request->pt);
                }
            }
            /* === SEARCH PRODUCT, CATEGORY NAME === */
            if($request->search && $request->search != null){
                $flag = 1;
                $search = $request->search;
                $productData = $productData->where('name', 'like', '%' . $search . '%');
                $category = Category::where('name','like','%' . $search . '%')->first();
                if($category) {
                    $productData = $productData->orWhereRelation('productCategory.category', 'name', 'like', '%' . $search . '%');
                } 
            }

            $productData = $productData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.product.index', compact('productData','flag'));
            
        }catch(Exception $ex){
            \Log::error($ex); 
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create1($slug, $id){
        try {
            if($slug == '1'){
                $productData = [];
                $categories = Category::where('status', '1')->orderBy('name', 'ASC')->get();
                $brands = Brand::where('status', '1')->orderBy('name', 'ASC')->get();
                if($id > 0){
                    $productData = Product::with('productCategory', 'seoAnalysis')->where('id', $id)->first(); 
                }
                $allCombinations = Product::with('productVariation')->where('id', $id)->first();
                return view('backend.product.include.create-1', compact('productData', 'categories', 'allCombinations', 'slug', 'id','brands'));
            }
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function create2($slug, $id){
        try {
            if($slug == '2'){
                if($id > 0){
                    $productData = Product::with('productAttribute')->where('id', $id)->first(); 
                }
                $allCombinations = Product::with('productVariation')->where('id', $id)->first();
                return view('backend.product.include.create-2', compact('productData', 'allCombinations', 'slug', 'id'));
            }
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function create3($slug, $id){
        try {
            if($slug == '3'){
                $attribute = Attribute::with('variations')->where('status', '1')->get();
                if($id > 0){
                    $productData = Product::with('productAttribute')->where('id', $id)->first(); 
                }
                $allCombinations = Product::with('productVariation')->where('id', $id)->first();
                return view('backend.product.include.create-3', compact('productData', 'attribute', 'allCombinations',  'slug', 'id'));
            }
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function create4($slug, $id){
        try {
            if($slug == '4'){
                $allCombinations = Product::with('productVariation')->where('id', $id)->first();
                $variationData = $allCombinations->productVariation()->get();
                $restrictVariationMin = $restrictVariation = 0; 
                foreach($variationData as $va) {
                    $varCount = count($va->variation_id);
                    if( $restrictVariation < $varCount) {
                        $restrictVariation = count($va->variation_id);
                    }
                    elseif($restrictVariation > $varCount ){
                        $restrictVariation = count($va->variation_id);
                    }
                }
                
                $combinations = $allCombinations->productVariation()->paginate(config('app.paginate')); //
                if($id > 0){
                    $productData = Product::with('productAttribute')->where('id', $id)->first(); 
                }
                return view('backend.product.include.create-4', compact('allCombinations', 'productData', 'slug', 'id','combinations','restrictVariation'));
            }
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store1(Request $request){
        try{
            $validate = Validator::make(
                $request->all(), [
                    'category' => 'required',
                    'name' => 'required|string|min:2|max:100|unique:products,name,'.$request->product_id,
                    'type' => 'required',
                    // 'brand' => 'required',
                    'regular_price' => 'exclude_if:type,2|required|numeric|gt:0',
                    'sale_price' => 'nullable|numeric|lte:regular_price|gt:0',
                    'title' => 'nullable|max:100',
                    'description' => 'nullable|max:500',
                    'meta_keywords' => 'nullable|max:100',
                ],
                [
                    'name.required' => 'The product name field is required.',
                    'name.unique' => 'The product name has already been taken.',
                    'name.min' => 'The product name must be at least 2 characters.',
                    'name.max' => 'The product name must not be greater than 100 characters.',
                    'type.required' => 'The product type field is required.',
                    // 'brand.required' => 'The product brand field is required.',
                    'category.required' => 'The product category field is required.',
                    'title.max' => 'The SEO title must not be greater than 100 characters.',
                    'description.max' => 'The meta description must not be greater than 255 characters.',
                    'meta_keywords.max' => 'The meta keywords must not be greater than 100 characters.',
                ]
            );
            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }
            $product = [
                'type' => $request['type'],
                'brand_id' => $request['brand'] ? $request['brand'] : null,
                'category_id' => $request['category'][0],
                'name' => $request['name'],
                'slug' => $request["product_id"] ?  Product::find($request["product_id"])->slug : SlugService::createSlug(Product::class, 'slug', $request->name),
                'regular_price' => ($request['type'] == 1) ? $request['regular_price'] : null,
                'featured_product' => $request['featured_product'],
                'sale_price' => $request['type'] == 1 ? ($request['sale_price'] == null ? null : $request['sale_price']  ) : null,
                'step_status' => '1',
            ];

            if($request['product_id'] > 0){
                Product::where('id', $request['product_id'])->update($product);
                $product_id = $request['product_id'];
            }else{
                $productData = Product::create($product);
                $product_id = $productData->id;
            }

            /* ===== SAVE/UPDATE PRODUCT CATEGORY ===== */
            if(isset($request['category'])){
                ProductCategories::where('product_id', $product_id)->delete();
                foreach($request['category'] as $catVal){
                    $ProductCategoryData = [
                        'product_id' => $product_id,
                        'category_id' => $catVal,
                    ];
                    ProductCategories::create($ProductCategoryData);
                }
            }

            /* ===== SEO ===== */
            $seoData = [
                'from' => 'Product',
                'from_id' => $product_id,
                'title' => $request['title'],
                'description' => $request['description'],
                'meta_keywords' => $request['meta_keywords'],
            ];
            $seoAnalysisData = SeoAnalysis::where('from', 'Product')->where('from_id', $product_id)->first();
            if($seoAnalysisData){
                $seoAnalysisData->update($seoData);
            }else{
                SeoAnalysis::create($seoData);
            }
            if($request->whichClick == '1'){
                return back();
            }else{
                $url = dirname(url()->current()).'/create2/2/'.$product_id;
            }

            return redirect($url);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function store2(Request $request){
        // try{
            $rules = [
                // 'sku' => 'required|max:255',
                'stock_status' => 'required',
                'product_information' => 'required',
                
            ];

            if(!$request['featured_image']){
                if($request['product_id'] != '' || $request['product_id'] != null){
                    $product = Product::find($request['product_id']);
                    $productFImage = $product->getMedia('featured_product_image')->count();
                    if($productFImage == 0){
                        $rules['featured_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                    }
                }
            }
            $validate = Validator::make(
                $request->all(), $rules,
                [
                    // 'sku.required' => 'The product SKU field is required.',
                    'sku.max' => 'The product SKU must not be greater than 255 characters.',
                    'featured_image.required' => 'The product featured image is required.',
                ]
            );
            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }
             $product = [
                'sku' => $request['sku'],
                'stock_status' => $request['stock_status'],
                'product_information' => $request['product_information'],
                'additional_information' => $request['additional_information'],
                'step_status' => '2',
            ];

            if($request['product_id'] != '' || $request['product_id'] != null){
                $product = Product::where('id', $request['product_id'])->update($product);
                $product_id = $request['product_id'];
            }
            /* === PRODUCT IMAGE === */
            if ($request['image']) {
                foreach ($request->file('image') as $photo) {
                    if(($photo[0]->extension() == 'jpeg') || ($photo[0]->extension() == 'jpg') || ($photo[0]->extension() == 'png')){
                        // $size = (($photo[0]->getSize()) / 1024);
                        // if($size < 2048){
                            $productMedia = Product::find($request['product_id']);
                            $newFileName = 'DNZ-PRODUCT-'. Str::random(20) .'.'.$photo[0]->extension();
                            $productMedia->addMedia($photo[0])->usingFileName($newFileName)->toMediaCollection('product');
                        // }
                    }
                }
            }
            /* === PRODUCT FEATURE IMAGE === */
            if ($request['featured_image']) {
                if(($request['featured_image']->extension() == 'jpeg') || ($request['featured_image']->extension() == 'jpg') || ($request['featured_image']->extension() == 'png')){
                    $size = (($request['featured_image']->getSize()) / 1024);
                    if($size < 2048){
                        $productMedia = Product::find($request['product_id']);
                        $newFileName = 'DNZ-PRODUCT-'. Str::random(20) .'.'.$request['featured_image']->extension();
                        $productMedia->addMedia($request['featured_image'])->usingFileName($newFileName)->toMediaCollection('featured_product_image');
                    }
                }
            }
            if($request->whichClick == '1'){
                return back();
            }else{
                $url = dirname(url()->current()).'/create3/3/'.$product_id;
            }

            return redirect($url);
        // } catch (Exception $ex) {
        //     \Log::error($ex);
        //     return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        // }
    }

    public function store3(Request $request){
        try{
            // return $request;
            $productType = Product::where('id', $request['product_id'])->first();
            if($productType["type"] == 2) {
                $valid = false;
                $attrs = Attribute::where('status', '1')->get();
                foreach($attrs as $attr){
                    if($request[$attr->slug.'_attribute_id']){
                        $valid = false;
                        break;
                    }else{
                        $valid = true;
                    }
                }

                if($valid){
                    $validate = Validator::make($request->all(), [
                        'attribute' => 'required',
                    ]);
                    if($validate->fails()){
                        return back()->withErrors($validate->errors())->withInput();
                    }
                }
            }

            $attributesValue = [];
            $attributesId = [];
            $priority = [];
            $allCombinations = [];
            $combinationData = '';
            $product_id = $request['product_id'];
            $attributes = Attribute::get();
            $priority  = 1;
            // return $request;
            foreach($attributes as $attribute){
                if($request[$attribute->slug.'_attribute_value']){
                    $attributesValue[] = $request[$attribute->slug.'_attribute_value'];
                    $attributesId[] = $request[$attribute->slug.'_attribute_id'];
                    // $priority[] = $request[$attribute->slug.'_priority'];

                    /* === SAVE/UPDATE PRODUCT ATTRIBUTE === */
                    $productAttributeData = ProductAttribute::where('product_id', $product_id)->where('attribute_id', $request[$attribute->slug.'_attribute_id'])->first();
                    $priority = $request[$attribute->slug.'_priority'] ? $request[$attribute->slug.'_priority'] : $priority++;
                    $data = [
                        'product_id' => $request['product_id'],
                        'attribute_id' => $request[$attribute->slug.'_attribute_id'],
                        'priority' => $priority,
                        'variation_id' => json_encode($request[$attribute->slug.'_attribute_value']),
                    ];

                    if($productAttributeData){
                        $productAttributeData->update($data);
                    }else{
                        ProductAttribute::create($data);
                    }
                }
            }
            $allCombinations = combinations($attributesValue); // From Helper

            $productVariationData = ProductVariation::where('product_id', $product_id)->get();
            $orderChargeId = OrderItem::where("product_id",$product_id)->pluck("variation_id")->toArray();

            /* === SAVE/UPDATE PRODUCT VARIATION === */
            // ProductVariation::where("product_id",$product_id)->whereNotIn("id",$orderChargeId)->delete();
            $variationCurrentCount = 0;
            foreach($allCombinations as $combinationKey => $combinationVal){
                $combinationVal = is_array($combinationVal) ? $combinationVal : [$combinationVal];
                $variationCurrentCount = count( $combinationVal);
                $combinationValTemp = [];
                foreach(  $combinationVal as $combinationTemp) { 
                    $combinationValTemp[] = (string) $combinationTemp;
                }
                $combinationVal =  $combinationValTemp;
                $varData = [
                    'product_id' => $product_id,
                    'variation_id' => $combinationVal,
                ];
                // return $product_id;
                if(isset($productVariationData) && $productVariationData != []){
                    $variationDataValue = ProductVariation::where('product_id', $product_id)->whereJsonContains('variation_id', $combinationVal)->first();
                    if(!$variationDataValue){
                        ProductVariation::create($varData); 
                    }else{
                        //    return count($variationDataValue['variation_id']);
                        if(count($variationDataValue['variation_id']) < count($combinationVal)) 
                        {
                            if( in_array($variationDataValue->id,$orderChargeId) < -1)
                            {
                                $variationDataValue->delete();
                            }
                        }
                    }
                }else{
                    ProductVariation::create($varData);
                }
            }

            // return  $variationCurrentCount;
            $productVariationData = ProductVariation::where('product_id', $product_id)->get();
            foreach($productVariationData as $variationData) {
                if( count($variationData["variation_id"]) < $variationCurrentCount) {
                    $variationData = $variationData->update(["status" => '2']);
                }
            }

             if($request->whichClick == '1'){
                return back();
            }else{
                if($productType->type == '1'){
                    if($productType->status == '2'){    
                        $productType->update(['status' => '1', 'step_status' => '3']);
                    }
                    \Session::flash('success', 'Product saved successfully!');
                    $url = dirname(url()->current());
                }else{
                    $url = dirname(url()->current()).'/create4/4/'.$product_id;
                }
            }

            
           
            return redirect($url);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function store4(Request $request){
        try{
            $validate = Validator::make($request->all(), [
                'regular_price' => 'required',
            ]);
            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }
            if($request->count > 0){
                for($i = 0; $i <= $request->count-1; $i++){
                    $prodVarData = [
                        'regular_price' => $request->regular_price[$i] ? $request->regular_price[$i] :  null,
                        'sale_price' => $request->sale_price[$i] ? $request->sale_price[$i] : null,
                        'sku' => $request->sku[$i] ?? null,
                        'stock_status' => $request->stock_status[$i] ?? null,
                        'status' => $request->status_value[$i] ?? null,
                    ];
                    ProductVariation::where('id', $request->product_variations_id[$i])->update($prodVarData);

                    if ($request->file('image'.$i)) {
                        if(($request->file('image'.$i)->extension() == 'jpeg') || ($request->file('image'.$i)->extension() == 'jpg') || ($request->file('image'.$i)->extension() == 'png')){
                            $size = (($request->file('image'.$i)->getSize()) / 1024);
                            if($size < 2048){
                                $variationMedia = ProductVariation::find($request->product_variations_id[$i]);
                                $newFileName = 'DNZ-PRODUCT-'.Str::random(20) .'.'.$request->file('image'.$i)->extension();
                                $variationMedia->addMedia($request->file('image'.$i))->usingFileName($newFileName)->toMediaCollection('product');
                                ;
                            }
                        }
                    }
                }

                $productData = Product::where('id', $request['product_id'])->first();
                if($productData->status == '2'){
                    $productData->update(['status' => '1', 'step_status' => '4']);
                }
                
                if($request->whichClick == '1'){
                    session()->flash('success','Product saved successfully!');
                    return back();
                    // return  url()->previous();//(request()->query());
                    // $url = dirname(url()->current()).'/create4/4/'.$request['product_id'];
                }else{
                    $url = dirname(url()->current());
                }

                return redirect($url)->with('success','Product saved successfully!');
            }
        } catch (Exception $ex) {
            \Log::error($ex);
            abort(500);
            // return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* === ON ATTRIBUTE SELECT === */
    public function productAttribute(Request $request){
        $attribute = Attribute::with('variations')->where('id', $request->attribute)->first();
        $attributeData = view('backend.product.include.product-attribute',compact('attribute'))->render();
        return response()->json([ 'status' => 'success', 'output' => $attributeData ]);
    }

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function productStatus($id){
        try {
            $status = Product::where('id', $id)->first()->status;
            $product['status'] = $status ? '0' : '1';
            $product['id'] = $id;
            Product::where('id', $id)->update([ 'status' => $product['status'] ]);
            $productStatus = view('backend.product.include.status', compact('product'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully', 'output' => $productStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function removeAttribute($id){
        try {
                $productAttribute = ProductAttribute::find($id);
                $productVariations =  ProductVariation::where('product_id', $productAttribute['product_id'])->get();
                $prodVarArray = json_decode($productAttribute['variation_id']);
                if($productVariations) {
                    foreach ($productVariations as $key => $productVariation) {
                        $prodVar =  is_array($productVariation['variation_id']) ? $productVariation['variation_id'] : [$productVariation['variation_id']];
                        $checkArray = \Arr::where($prodVar, function ($value, $key) use ($prodVarArray) {
                            if(in_array($value,$prodVarArray) > 0) {
                                return $value;
                            }
                        });
                        if(count($checkArray)) {
                            $productVariation->delete();
                        }
                    }  
                }
                $productAttribute->delete();       
                return response()->json([ 'status' => 'success' ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function destroyMedia($id)
    {
        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($id);
            
            $productImages = 0;
            $productFImage = 0; 
            $productData = Product::find($media->model_id);
            $media->delete();
            if($productData){
                $productImages = $productData->getMedia('product')->count();
                $productFImage = $productData->getMedia('featured_product_image')->count();
            }
            $data= [
                'productFImage' => $productFImage,
                'productImages' => $productImages
            ];
            return response()->json(['status' => 'success', 'message' => 'Image removed successfully!', 'data' => $data]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage(),]);
        }
    }
}