<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\{HomeController, CheckoutController, ProductController, CartController, CouponController, SubscriptionController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('back_button')->group(function(){
    /* =============== AUTH ROUTE =============== */
    // Auth::routes();
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('/password/email', 'Auth\RegisterController@resetPassword')->name('password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@customReset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('admin-login', 'Auth\AdminLoginController@login')->name('admin-login');
    Route::get('test-pdf', function () {
        return view('frontend\pdf\testpdf');
    });

    Route::get('/', function () {
        // if (auth()->guard('admin')->check()) {
        //     return redirect()->route('admin-home');
        // }elseif(auth()->guard('web')->check()) {
        //     return redirect()->route('user.dashboard');
        // } else {
        return redirect()->route('admin.home');
        // }
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/projection-booth', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin-home');
        } else {
            return redirect()->route("admin.login");
        }
    })->name('admin.home');

    Route::get('/projection-booth/login', [LoginController::class, 'adminLoginForm'])->name('admin.login'); //->middleware('admin');

    /* =============== PROXY LOGIN ROUTE =============== */
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/proxy_login/{id}', 'Backend\UserController@proxyLogin');
    });
    //   Route::middleware('back_button')->group(function () {

        
    //     });

    /* ============================== ADMIN ROUTES ============================== */
    Route::group(['middleware' => 'auth:admin', 'namespace' => 'Backend', 'prefix' => 'projection-booth'], function () {

        /* =============== DASHBOARD MANAGEMANT ROUTE =============== */
        Route::get('dashboard', 'DashboadController@index')->name('admin-home');

        /* =============== CUSTOMER MANAGEMANT ROUTE =============== */
        Route::resource('customer', 'UserController');
        Route::get('user-status/{id}', 'UserController@userStatus')->name('customer.status');

        /* =============== CATEGORY MANAGEMANT ROUTE =============== */
        Route::resource('category', 'CategoryController');
        Route::get('category-status/{id}', 'CategoryController@categoryStatus')->name('category.status');
        Route::get('category-media-delete/{id}', 'CategoryController@destroyMedia')->name('category.destroyMedia');

        /* =============== ATTRIBUTE MANAGEMANT ROUTE =============== */
        Route::resource('attribute', 'AttributeController');
        Route::get('attribute-status/{id}', 'AttributeController@attributeStatus')->name('attribute.status');

        /* =============== ATTRIBUTE VARIANT MANAGEMANT ROUTE =============== */
        Route::resource('variant', 'VariationController');
        Route::get('variant/{id}', 'VariationController@show')->name('variant.index');
        Route::get('variation-status/{id}', 'VariationController@variationStatus')->name('variation.status');

        /* =============== PRODUCT MANAGEMANT ROUTE =============== */
        Route::resource('product', 'ProductController');

        /* === STEP-1 === */
        Route::get('product/create1/{slug}/{id}', 'ProductController@create1')->name('product.create1');
        Route::post('product/store1', 'ProductController@store1')->name('product.store1');

        /* === STEP-2 === */
        Route::get('product/create2/{slug}/{id}', 'ProductController@create2')->name('product.create2');
        Route::post('product/store2', 'ProductController@store2')->name('product.store2');

        /* === STEP-3 === */
        Route::get('product/create3/{slug}/{id}', 'ProductController@create3')->name('product.create3');
        Route::post('product/store3', 'ProductController@store3')->name('product.store3');

        /* === STEP-4 === */
        Route::get('product/create4/{slug}/{id}', 'ProductController@create4')->name('product.create4');
        Route::post('product/store4', 'ProductController@store4')->name('product.store4');

        Route::get('product-status/{id}', 'ProductController@productStatus')->name('product.status');
        Route::get('product-removeattribute/{id}', 'ProductController@removeAttribute')->name('product.removeattribute');
        Route::get('product-attribute', 'ProductController@productAttribute')->name('product.attribute');
        Route::get('product-media-delete/{id}', 'ProductController@destroyMedia')->name('product.destroyMedia');

        /* =============== COUPON MANAGEMANT ROUTE =============== */
        Route::resource('coupon', 'CouponController');
        Route::get('coupon-status/{id}', 'CouponController@couponStatus')->name('coupon.status');
        Route::post('apply-on', 'CouponController@couponApplyOn')->name('coupon.applyon');

        /* =============== CONTACT US ROUTE =============== */
        Route::resource('contact-us', 'ContactUsController');

        /* =============== CHANGE PASSWORD ROUTE =============== */
        Route::resource('change-password', 'ChangePasswordController');

        /* =============== CUSTOMER SUBSCRIPTION MANAGEMANT ROUTE =============== */
        Route::get('subscriber', 'ContactUsController@subscriptionList')->name('conatct.subscriber');

        /* =============== TRANSACTION MANAGEMANT ROUTE =============== */
        Route::resource('transaction', 'TransactionController');

        /* =============== FAQ MANAGEMANT ROUTE =============== */
        Route::resource('faq', 'FaqController');
        Route::get('faq-status/{id}', 'FaqController@faqStatus')->name('faq.status');

        /* =================== PAGE MANAGEMANT ROUTE =======================*/
        Route::resource('page', 'PagesController');
        Route::get('page-status/{id}', 'PagesController@pageStatus')->name('page.status');

        /* =============== TAX MANAGEMANT ROUTE =============== */
        Route::resource('tax', 'TaxController');
        Route::get('tax-status/{id}', 'TaxController@taxStatus')->name('tax.status');

        /* =============== SHIPPING MANAGEMANT ROUTE =============== */
        Route::resource('shipping', 'ShippingController');
        Route::get('shipping-status/{id}', 'ShippingController@shippingStatus')->name('shipping.status');

        /* =============== REVIEW MANAGEMANT ROUTE =============== */
        Route::resource('review', 'ReviewController');
        Route::get('review-status/{id}', 'ReviewController@reviewStatus')->name('review.status');

        /* =============== BLOG MANAGEMANT ROUTE =============== */
        Route::resource('blogs', 'BlogController');
        Route::get('blog-media-delete/{id}', 'BlogController@destroyMedia')->name('blog.destroyMedia');
        Route::get('blog-status/{id}', 'BlogController@blogStatus')->name('blog.status');

        /* =============== TESTIMONIAL MANAGEMANT ROUTE =============== */
        Route::resource('testimonial', 'TestimonialController');
        Route::get('testimonial-status/{id}', 'TestimonialController@testimonialStatus')->name('testimonial.status');

        /* =================== REPORT MANAGEMANT ROUTE =======================*/
        Route::get('customer-report', 'ReportController@customerReport')->name('customer.report');
        Route::get('order-report', 'ReportController@orderReport')->name('order.report');
        Route::get('analytics', 'ReportController@analytics')->name('analytics');

        /* =================== DEALER MANAGEMANT ROUTE =======================*/
        Route::resource('dealer', 'DealerController');
        // Route::post('dealer', 'DealerController@getDealers')->name('get-dealers');
        Route::get('dealer-status/{id}', 'DealerController@dealerStatus')->name('dealer.status');
        Route::get('dealer-media-delete/{id}', 'DealerController@destroyMedia')->name('dealer.destroyMedia');

        /* =============== ORDER MANAGEMANT ROUTE =============== */
        Route::resource('order', 'OrderController');
        Route::get('order-status/{id}', 'OrderController@orderStatus')->name('order.status');
        Route::get('order-invoice/{id}', 'OrderController@downloadInvoice')->name('order.invoice');

        /* =============== PROFILE MANAGEMANT ROUTE =============== */
        Route::resource('profile', 'ProfileSettingController');

        /* =============== SETTING MANAGEMANT ROUTE =============== */
        Route::resource('setting', 'SettingController');

        /* =============== Product Info ROUTE =============== */
        Route::resource('product-info', 'ProductInfoController');
    });

    /* ============================== USER ROUTES ============================== */
    Route::group(['middleware' => 'auth'], function () {

        /* =============== DASHBOARD MANAGEMANT ROUTE =============== */
        // Route::resource('dashboard', Frontend\DashboardController::class);
        Route::get('dashboard', 'Frontend\DashboardController@index')->name('user.dashboard');

        /* =============== ADDRESS MANAGEMANT ROUTE =============== */
        Route::resource('address', 'Frontend\AddressController');

        /* =============== REVIEW MANAGEMANT ROUTE =============== */
        // Route::resource('review', 'Frontend\ReviewController',['as'=>'user']);
        Route::get('review/{slug}/{order_id}', 'Frontend\ReviewController@create')->name('user.review.create');
        Route::post('review/{slug}/{order_id}', 'Frontend\ReviewController@store')->name('user.review.store');

        /* =============== ORDER MANAGEMANT ROUTE =============== */
        Route::get('orders', 'Frontend\OrderController@index')->name('orders.index');
        Route::get('orders/detail/{id}', 'Frontend\OrderController@orderDetail')->name('orders.details');
        Route::get('download-invoice/{id}', 'Frontend\OrderController@downloadInvoice')->name('orders.downloadInvoice');

        Route::resource('user-change-password', Frontend\ChangePasswordController::class);
        Route::get('my-profile', 'Frontend\ProfileController@index')->name('dashboard.myprofile');
        Route::post('my-profile/update', 'Frontend\ProfileController@update')->name('dashboard.myprofile.update');
    });



    /* =============== FRONTEND ROUTES =============== */

    Route::group([], function () {
        /* === ALL PRODUCTS === */
        // Route::get('products', 'Frontend\ProductController@index');

        Route::get('make-payment', [CheckoutController::class, 'makePayment'])->name('checkout.makePayment');
        Route::post('make-payment', [CheckoutController::class, 'paymentStore'])->name('checkout.makePayment.store');

        Route::get('products', [ProductController::class, 'index'])->name('frontend.products.index');
        /* =============== SINGLE PRODUCT FRONTEND | ROUTES =============== */
        Route::get('product/{slug}', [ProductController::class, 'singleProduct'])->name('product.detail');
        Route::post('product/submit-review', [ProductController::class, 'addReview'])->name('product.addReview');
        
        Route::post('subscription', [SubscriptionController::class, 'store'])->name('home.subscription');

        // Blog route
        Route::get('blog', 'Frontend\BlogController@index')->name('blog');
        Route::get('blog/{slug}', 'Frontend\BlogController@blogDetails')->name('blog-details');
        // WhyDNZ Route
        Route::get('product-info', 'Frontend\WhydnzController@index')->name('why-dnz');
        // contact-us route
        Route::get('contact', 'Frontend\ContactUsController@create')->name('contact');
        Route::post('contact', 'Frontend\ContactUsController@store')->name('contact-us.save');
        // HELP-CENTER ROUTE
        Route::get("help-center", function () {
            return view('frontend.pages.help-center.help-center');
        })->name('help-center');
        /* =============== FAQ MANAGEMANT ROUTE =============== */
        Route::resource('faqs', 'Frontend\FaqController');
        Route::get('faqs-info', 'Frontend\FaqController@faqInfo')->name('faq.info');



        /* =============== CART & CHECKOUT ROUTE =============== */
        Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
        Route::post('cart/{slug}', [CartController::class, 'addToCart'])->name('cart.store');
        Route::get('product-filter/{slug}', [CartController::class, 'variationFilter'])->name('variationFilter');
        Route::get('address-fill/{id}', [CartController::class, 'AddressFilter'])->name('fill.address');
        Route::get('tax-calculation', [CartController::class, 'taxShippingCalculation'])->name('tax.shipping.calculation');
        Route::get('price-calculation', [CartController::class, 'priceCalculation'])->name('price.calculation');
        Route::get('clear-filter/{slug}', [ProductController::class, 'clearFilter'])->name('product.clear.filter');



        Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
        Route::get('remove', [CartController::class, 'removeCart'])->name('cart.remove');
        Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
        Route::get('thank-you', [CheckoutController::class, 'thankyou'])->name('thank-you');

        /* =============== APPLY COUPON ROUTE =============== */
        Route::post('apply-coupon', [CouponController::class, 'index'])->name('coupon');

        /* =============== DEALER LOCATOR ROUTE =============== */
        Route::get('dealer-locator', 'Frontend\DealerLocatorController@index')->name('dealer-locator');
        Route::get('temp', [ProductController::class, 'temp'])->name('temp');
        Route::get('Categorytemp', [ProductController::class, 'Categorytemp'])->name('Categorytemp');


    });

});

