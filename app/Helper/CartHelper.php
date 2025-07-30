<?php

use App\Models\Coupon;

function addOrUpdateCart($product,$quantity,$attributeRequest,$imgURL,$price) {

    $cartItems = \Cart::content();
    //  $cartItems = \Session::get('cart');
    //  return $cartItems = collect($cartItems)->where('id',$product['id'])->first();
    
    if ($cartItems->has($product->id))
    {
        $cartItems = \Cart::content();
        \Cart::update($product['id'], array(
            'qty' => $quantity,
        ));
    } else {
        $cart = [
            'id' => $product["id"],
            'name' => $product['name'],
            'price' =>   $price,
            // 'sale' =>  $product['sale_price'] ? $product['sale_price'] : $product['regular_price'], 
            'qty' => $quantity ?? "NA",
            'taxRate' => 0,
            'options' => array(
                'image' => $imgURL,
                'attribute' => $attributeRequest,
                'coupon' => false,
                'variation_id' => $product['variation_id']
            )
        ]; 
        // $cartData = \Session::get('cart') ?? [];
        // array_push($cartData,$cart);    
        // Session::forget('cart');
        \Cart::add($cart);
        // \Session::put('cart',$cartData);
    }

    // \Cart::add($cart);
}

function totalCartCount(){
    return \Cart::content()->count();
}

function totalQty(){
    return \Cart::content()->sum('qty');
}

function cartItems()
{
    // return \Session::get('cart');
    return \Cart::content();
}


function cartClear()
{
    \Session::flush();
}
// \Session::put('cart',[
//     "id"=> 1,
//     "name"=> "sadasd",
//     "price"=> 12,
//     "quantity"=> 2,
//     "attributes"=> [
//         "image"=> "http://dnz.c247.website/front-end/assets/image/single-product-1.jpg",
//         "attribute"=> []
//     ],
// ]);
// return  \Session::get('cart');



function totalAmount()
{
    $total = (float)str_replace(',','',\Cart::subtotal());
    
    $shipping = session()->has('shipping') ? collect(session('shipping'))->sum('tax') : 0; 
    $tax = session()->has('tax') ? collect(session('tax'))->sum('taxInDollar') : 0; 
    $coupon = session()->has('coupon') ? (session()->has('free-product') ? 0 : session('coupon')['charge'])  : 0;
    return ($total + $shipping + $tax) - $coupon;
}

function subAmount()
{
    $total = \Cart::subtotal();
    return $total;
}

function updateCart($rowId,$qty)
{
    \Cart::update($rowId,[
        'qty' => $qty,
    ]);
}

function removeFreeProduct() {
    $cart = \Cart::content()->where('options.coupon',true)->first();
    if($cart)
    \Cart::remove($cart->rowId);
}