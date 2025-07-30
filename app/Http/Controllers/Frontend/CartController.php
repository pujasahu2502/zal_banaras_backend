<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Address, Product, Attribute, Variation,Tax,Shipping};
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartList()
    {
        // \Cart::destroy();
        $cartItems =  cartItems();
        return view('frontend.pages.cart.cart', compact('cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request, $slug)
    {
        // return $request;
        if ($request->ajax()) {
            $product = Product::where('slug', $slug)->with('productVariation')->first();
            $variationId = $product->productVariation()->where('status','1')->where('stock_status','!=','Out of stock')->pluck('variation_id');
            $highestVariationCount = 0 ;
            foreach ($variationId as $key => $variation11) {
                if($highestVariationCount < count($variation11)){
                    $highestVariationCount = count($variation11);
                }
            }
            // return  $product;
            $attributeData = Attribute::pluck('slug');
            $attributeRequest = [];
            foreach ($attributeData as $attributeValue) {
                if ($request->has($attributeValue))
                    $attributeRequest[$attributeValue] = $request[$attributeValue];
            }
            $quantity = $request["qty"] ?? 1;
            $price = 0;
            if ($product["type"] == '2' && $highestVariationCount  == count($attributeRequest)) {
                $variationData = Variation::whereIn('id', $attributeRequest)->pluck('id');
                $tempArray = [];
                foreach($variationData as $json) {
                    $tempArray[] = (string)$json;
                }
                if(count($tempArray) == 0) {
                    $tempArray = $tempArray[0];
                }
                // return $tempArray;
                $variationData = $product->productVariation()->whereJsonContains('variation_id',$tempArray)->where('status','1')->where('stock_status','!=','Out of stock')->first();
               
                if (empty($variationData) || isset($variationData["status"]) && $variationData["status"] == "0") {
                    return response()->json(["status" => "error", "variantStatus" => "true", "message" => "The " . $product['name'] . " variant is not currently available."]);
                }else{
                    $product['variation_id'] =  $variationData->id;
                    $price = $variationData['sale_price'] ? $variationData['sale_price'] : $variationData['regular_price'];
                }
                
            } else {
                $price =  $product['sale_price'] ? $product['sale_price'] : $product['regular_price'];
            }
            
            try {
                if(count($attributeRequest)) {
                    foreach ($attributeRequest as $key =>  $variationId) {
                        $attributeRequest[$key] = Variation::find($variationId)->name ?? '-';
                    }
                }
                $productURL = $product->getMedia('featured_product_image')->first() ? $product->getMedia('featured_product_image')[0]->getUrl() :  asset('front-end/assets/image/single-product-1.jpg');
                if($highestVariationCount  == count($attributeRequest)) {
                    $url = null;
                    $cartItems = \Cart::content();
                    $product = Product::where('slug', $slug)->with('productVariation')->first();
                    if ($cartItems->where('id',$product->id)->first()) {
                        $url = route('cart.list');
                        session()->flash('success', ucwords($product['name']) .' was successfully added to your cart');
                    }
                    addOrUpdateCart($product, $quantity, $attributeRequest, $productURL, $price);
                    return response()->json(['status' => 'success', "message" => ucwords($product['name']) .' was successfully added to your cart', 'cart' => totalQty(), 'url' => $url]);
                }
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                return $e->getMessage();
            }
            return response()->json(['status'=> 'error',"message" => "Please select some product options before adding this product to your Cart" ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', __('cart_update_success_msg'));
        return redirect()->route('cart.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeCart(Request $request)
    {
        \Cart::remove($request->cart);
        session()->flash('success', __('cart_remove_success_msg'));
        return redirect()->route('cart.list');
    }


    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', __('delete_all_cart_products_msg'));
        return redirect()->route('cart.list');
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function checkoutCartList()
    // {
    //     $cartItems = \Cart::getContent();
    //     $totalPrice = \Cart::getTotal();
    //     return view('frontend.pages.checkout.checkout', compact('cartItems', 'totalPrice'));
    // }


    // return $differenceArray = array_diff([1,4,8,12], [1,4,8,11]);

    public function variationFilter(Request $request,$slug)
    {
        if($request->except('qty')) {
            $product = Product::where('slug', $slug)->with('productVariation')->first();



            $attributeData = Attribute::pluck('slug');
            $attributeRequest = [];
            $html = '';
            foreach ($attributeData as $attributeValue) {
                if ($request->has($attributeValue)){

                    $attributeRequest[$attributeValue] = $request[$attributeValue];
                    $html .= $attributeValue.' : '.$request[$attributeValue].' ';
                }
            }

            $variationId = $product->productVariation()->where('status','1')->where('stock_status','!=','Out of stock')->pluck('variation_id');
            // $attributeRequestArrayCheck =  array_values($attributeRequest);
            // foreach ($attributeRequestArrayCheck as $key => $attributeReq) {
            //     $variationTempArray = $product->productVariation()->where('status','1')->whereJsonContains('variation_id',[$attributeReq])->pluck('variation_id');
            //     foreach ($variationTempArray as  $var) {
            //         $variationId[] = $var;
            //     }
            // }
            // return $variationId;

            $attributeRequestArrayCheck = array_values($attributeRequest);
            $attributeRequestArrayCheck =  Variation::select('id','attribute_id','name','slug','status')->whereIn('id',$attributeRequestArrayCheck)->pluck('id')->toArray();

            // return  $variationId;
            
            $variationId2 = [];
            $highestVariationCount = 0;
            foreach ($variationId as $key => $variation11) {
                if($highestVariationCount < count($variation11)){
                    $highestVariationCount = count($variation11);
                }
                $attributeRequestFilter = $attributeRequest;
                if(count($attributeRequest) == $highestVariationCount ) {
                    array_pop($attributeRequestFilter);
                }

                if(  count(array_intersect($variation11,$attributeRequestFilter)) >= (count($attributeRequestFilter)) && $highestVariationCount == count($variation11)){
                    $variationId2[] = $variation11;
                    // print_r($variationId2);
                }
            }
            // return $variationId2;
            $variationArr = [];
            foreach ($variationId2 as $variation) {
                foreach ($variation as $variation1) {
                    if(in_array($variation1,$variationArr) == 0)
                        $variationArr[] = $variation1;
                }
            } 
            // return $variationArr;
            $producAttributeData =  $product->productAttribute()->orderBy('priority','ASC')->get()->groupBy('attribute.slug');
            $sorting = array_keys($producAttributeData->toArray());
    
           $variationList1 =  Variation::select('id','attribute_id','name','slug','status')->whereIn('id',$variationArr)->with('attribute')->get()->groupBy('allAttribute.slug')->sortKeys();
    
            $variationList = $variationList1->sortBy(function($model) use ($sorting) {
                // dd(collect($model)->first()->attribute->slug);
                return array_search(collect($model)->first()->attribute->slug, $sorting);
            });
            
            $variationData = $product->productVariation()->get();
            $restrictVariation = 0; 
            foreach($variationData as $va) {
                $varCount = count($va->variation_id);
                if( $restrictVariation < $varCount) {
                    $restrictVariation = count($va->variation_id);
                }
            }

            // $variationList =  Variation::select('id','attribute_id','name','slug','status')->whereIn('id',$variationArr)->with('attribute')->get()->groupBy('allAttribute.slug')->sortKeys();
            $variationCount = $variationList->count();
            $filterStatus = true;
            $filterOutput = view('frontend.pages.product.include.variation-filter',compact('attributeRequest','variationList','slug', 'filterStatus'))->render();
            // return $attributeRequest;
            if(count($attributeRequest) ==  $restrictVariation) {
                if ($product["type"] == '2') {
                    $variationData = Variation::whereIn('id', $attributeRequest)->pluck('id');
                    $tempArray = [];
                    foreach($variationData as $json) {
                        $tempArray[] = (string)$json;
                    }
                    if(count($tempArray) == 1) {
                        $tempArray = $tempArray[0];
                    }
                    // return $tempArray;
                    
                    $variationData = $product->productVariation()->whereJsonContains('variation_id',$tempArray)->where('status','1')->where('stock_status','!=','Out of stock')->first();
                    $price = "0";
                    if (empty($variationData) || isset($variationData["status"]) && $variationData["status"] == "0") {
                        $price = '0';
                        return response()->json(["status" => "error", "variantStatus" => "true", "message" => "The " . $product['name'] . " variant( ".$html." ) is not currently available.",'price' => $price, "sku" => ($variationData->sku ?? "NA"), 'filter' => true, 'output' => $filterOutput]);
                    }else{
                        $price = $variationData['sale_price'] ? $variationData['sale_price'] : $variationData['regular_price'];
                        $sku = $variationData->sku;
                    }
                }else{
                    $price = $product['sale_price'] ? $product['sale_price'] : $product['regular_price'];
                    $sku = $product->sku;
                }
                return response()->json(['status' => 'success', 'price' => $price, "sku" => ( $sku ?? "NA"),'filter' => true, 'output' => $filterOutput]);

            }

            return response()->json(["status" => 'success', 'filter' => true, 'output' => $filterOutput]);
        }

    }

    public function AddressFilter($id)
    {
        $address = Address::where('user_id',auth()->guard("web")->id())->find($id);
        return response()->json(["status" => "success", "address" => $address]);
    }

    public function taxShippingCalculation(Request $request)
    {
        if($request->ajax()) {

            $allTax = Tax::select('name','state','tax')->where("status",'1')->where("state",$request["state"])->get();
            $allShipping  = Shipping::select("zone_name as name", "state","fixed_amount as tax")->where("state",$request["state"])->where("status","1")->get();
          
            \Session::forget(["tax","shipping"]);
            \Session::put(["tax" => $allTax, "shipping" => $allShipping]);

            $taxOutput = view("frontend.pages.checkout.include.tax-shipping",["title" => "tax"])->render();
            $shippingOutput = view("frontend.pages.checkout.include.tax-shipping",["title" => "shipping"])->render();
            return response()->json([ "status" => "success", "taxOutput" => $taxOutput, "shippingOutput" => $shippingOutput, 'total' => number_format(totalAmount(),2)]);

        }

        abort('404');
    }
    public function priceCalculation(Request $request){
        try {
            updateCart($request['product_id'],$request['count']);
            $price = \Cart::get($request['product_id'])->subtotal();
            $totalPrice = \Cart::subtotal();
            return response()->json(['status' => 'success', 'price' => $price, "totalPrice" => $totalPrice]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
