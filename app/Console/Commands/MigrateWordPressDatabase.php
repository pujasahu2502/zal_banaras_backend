<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\User;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductCategories;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCharge;
use App\Models\Variation;
use App\Models\Brand;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;
use Str;
use App\Models\SeoAnalysis;
use Automattic\WooCommerce\Client;


class MigrateWordPressDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db-actions:migrate-wordpress-database {param} {page?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will consume the Wordpress API and insert the data into the respectives table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            ini_set('max_execution_time', 0);
            $param = $this->argument('param');
            $pageCount = $this->argument('page');
            if ($pageCount == 0) {
                $pageCount = 1;
            }

            switch ($param) {
                case 'attributes':
                    $data = [];
                    $response = $this->wooCommerceClientCall('wc/store', 'products/attributes');
                    if ($response) {
                        foreach ($response as $key => $value) {
                            $slug = $slugFormat = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value->name)));
                            $next = 1;
                            while (Attribute::where('slug', $slug)->first()) {
                                $slug = $slugFormat . $next;
                                $next++;
                            }
                            Attribute::updateOrCreate(
                                [
                                    'name' => $this->cleanName($value->name)
                                ],
                                [
                                    'id' => $value->id,
                                    'slug' => $slug
                                ]
                            );
                            $response2 = $this->wooCommerceClientCall('wc/store', "products/attributes/$value->id/terms");
                            if ($response2) {
                                foreach ($response2 as $key2 => $value2) {

                                    $slug = $slugFormat = $value2->slug;
                                    $next = 1;
                                    while (Variation::where('slug', $slug)->first()) {
                                        $slug = $slugFormat . $next;
                                        $next++;
                                    }

                                    Variation::updateOrCreate(
                                        [
                                            'name' => $this->cleanName($value2->name),
                                            'slug' => $slug,
                                            'attribute_id' => $value->id,
                                        ],
                                        [
                                            'status' => "1",
                                            'id' => $value2->id,
                                            'description' => $value2->description,
                                        ]
                                    );
                                }
                            }
                        }
                        $this->info('Product Attributes Migration Completed');
                        return;
                    }
                    $this->error('Error occurred in Product attributes request');
                    break;

                case 'categories':

                    $data = [];
                    $response = $this->wooCommerceClientCall('wc/store', 'products/categories');

                    if ($response) {
                        foreach ($response as $key => $value) {
                            Category::updateOrCreate(
                                [
                                    'name' => $value->name
                                ],
                                [
                                    'id' => $value->id,
                                    'slug' => $value->slug
                                ]
                            );
                        }
                        $this->info('Product Categories Migration Completed');
                        return;
                    }
                    $this->error('Error occurred in Product categories request');
                    break;
                case 'products':
                    $data = [];
                    for ($i = $pageCount; $i <= 50; $i++) {
                        $this->info($i);
                        $response = $this->wooCommerceClientCall('wc/store', 'products', $i, 1);
                        if ($response) {
                            if (count($response) > 0) {
                                foreach ($response as $key => $value) {
                                    $singleProduct = $this->wooCommerceClientCall('wc/v3', 'products/' . $value->id);
                                    if ($singleProduct) {
                                        $creratedProduct = $this->createOrUpdateProduct($singleProduct);
                                        if ($creratedProduct) {
                                            if ($singleProduct->type == "variable") {
                                                if (count($singleProduct->attributes) > 0) {

                                                    $createdAttributes = $this->createOrUpdateProductAttribute($singleProduct);

                                                    if ($createdAttributes) {
                                                        if (count($singleProduct->variations) > 0) {
                                                            $createdVariations = $this->createOrUpdateProductVariations($singleProduct);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $this->info('Products Migration Completed');
                    return;
                    break;

                case 'users':

                    $data = [];
                    // for($i = $pageCount; $i <= 50; $i++){
                    for ($i = $pageCount; $i <= 604; $i++) {

                        $response = $this->wooCommerceClientCall('wc/v3', 'customers', $i);
                        $this->info($i);
                        if ($response) {
                            foreach ($response as $key => $value) {

                                $user = User::where('email', $value->email)->first();

                                if (!$user) {
                                    $user = new User();
                                }

                                $user->email =  $value->email;
                                $user->id =  $value->id;
                                $user->first_name =  $value->first_name;
                                $user->last_name =  $value->last_name;
                                $user->username =  $value->username;
                                $user->display_name =  $value->username;
                                $user->password =  \Hash::make('123456789');
                                $user->status =  "1";
                                $user->type = "customer";
                                $user->save();


                                $user->assignRole('user');
                                $user->refresh();

                                Address::updateOrCreate(
                                    [
                                        'email' => $user->email,
                                        'user_id' => $user->id,
                                        'type' => 'order'
                                    ],
                                    [
                                        'first_name' => $value->billing->first_name,
                                        'last_name' => $value->billing->last_name,
                                        'address' => $value->billing->address_1 . ',' . $value->billing->address_2,
                                        'city' => $value->billing->city,
                                        'state' => $value->billing->state,
                                        'zipcode' => $value->billing->postcode,
                                        'mobile' => $value->billing->phone,
                                    ]
                                );
                                Address::updateOrCreate(
                                    [
                                        'email' => $value->email,
                                        'user_id' => $value->id,
                                        'type' => 'customer'
                                    ],
                                    [
                                        'first_name' => $value->shipping->first_name,
                                        'last_name' => $value->shipping->last_name,
                                        'address' => $value->shipping->address_1 . ',' . $value->shipping->address_2,
                                        'city' => $value->shipping->city,
                                        'state' => $value->shipping->state,
                                        'zipcode' => $value->shipping->postcode,
                                        'mobile' => $value->shipping->phone,
                                    ]
                                );
                            }
                        }
                    }
                    $this->error('Error occurred in Customer request');
                    break;
                case 'order':
                    $data = [];
                    // for($i = $pageCount; $i <= 203; $i++){
                    for ($i = $pageCount; $i <= 500; $i++) {

                        $this->info($i);
                        $response = $this->wooCommerceClientCall('wc/v3', 'orders', $i);

                        // $this->info(json_encode($response));
                        if ($response) {
                            foreach ($response as $key => $value) {
                                if ($value->customer_id == 0) {
                                    $userCheck = User::where('email', $value->billing->email)->first();
                                    if (empty($userCheck)) {
                                        $userData = User::create([
                                            'email' => $value->billing->email,
                                            'first_name' => $value->billing->first_name,
                                            'last_name' => $value->billing->last_name,
                                            'mobile' => $value->billing->phone,
                                            'type' => 'guest',
                                            'password' => \Hash::make('Qaz!123456'),
                                            'created_at' => $value->date_created
                                        ]);
                                        $userData->assignRole('user');
                                        $value->customer_id = $userData->id;
                                    }
                                }
                                $customerID = User::find($value->customer_id);
                                $this->info($customerID);
                                if ($customerID) {
                                    $customerID =  $customerID->id;
                                }
                                if ($customerID) {
                                    $productNotFound = [];
                                    foreach ($value->line_items as $key2 => $value2) {
                                        $check = Product::find($value2->product_id);
                                        if (!$check) {
                                            array_push($productNotFound, [
                                                'order_id' => $value->id,
                                                'order_key' => $value->order_key,
                                                'product_id' => $value2->product_id,
                                            ]);
                                        }
                                    }
                                    if (empty($productNotFound)) {
                                        $billingID = Address::where([
                                            'email' => $value->billing->email,
                                            'user_id' => $customerID,
                                            'first_name' => $value->billing->first_name,
                                            'last_name' => $value->billing->last_name,
                                            'address' => $value->billing->address_1 . ',' . $value->billing->address_2,
                                            'city' => $value->billing->city,
                                            'state' => $value->billing->state,
                                            'zipcode' => $value->billing->postcode,
                                            'mobile' => $value->billing->phone,
                                            'type' => 'order',
                                        ])->first();

                                        if (!$billingID) {
                                            $billingID = Address::create([
                                                'email' => $value->billing->email,
                                                'user_id' => $customerID,
                                                'first_name' => $value->billing->first_name,
                                                'last_name' => $value->billing->last_name,
                                                'address' => $value->billing->address_1 . ',' . $value->billing->address_2,
                                                'city' => $value->billing->city,
                                                'state' => $value->billing->state,
                                                'zipcode' => $value->billing->postcode,
                                                'mobile' => $value->billing->phone,
                                                'type' => 'order'
                                            ]);
                                            $billingID = $billingID->id;
                                        } else {
                                            $billingID = $billingID->id;
                                        }

                                        $shippingID = Address::where([
                                            'user_id' => $customerID,
                                            'first_name' => $value->shipping->first_name,
                                            'last_name' => $value->shipping->last_name,
                                            'address' => $value->shipping->address_1 . ',' . $value->shipping->address_2,
                                            'city' => $value->shipping->city,
                                            'state' => $value->shipping->state,
                                            'zipcode' => $value->shipping->postcode,
                                            'mobile' => $value->billing->phone,
                                            'type' => 'customer',
                                        ])->first();

                                        if (!$shippingID) {
                                            $shippingID = Address::create([
                                                'user_id' => $customerID,
                                                'first_name' => $value->shipping->first_name,
                                                'last_name' => $value->shipping->last_name,
                                                'address' => $value->shipping->address_1 . ',' . $value->shipping->address_2,
                                                'city' => $value->shipping->city,
                                                'state' => $value->shipping->state,
                                                'zipcode' => $value->shipping->postcode,
                                                'mobile' => $value->billing->phone,
                                                'type' => 'customer',
                                            ]);
                                            $shippingID = $shippingID->id;
                                        } else {
                                            $shippingID = $shippingID->id;
                                        }

                                        $priceIncTax = ($value->prices_include_tax === true) ? 1 : 0;
                                        $paymentStatus = ($value->date_paid_gmt == NULL) ? 1 : 2;

                                        $orderStatus = '2';
                                        if ($value->status == 'processing') {
                                            $orderStatus = '1';
                                        }
                                        if ($value->status == 'completed') {
                                            $orderStatus = '3';
                                        }
                                        if ($value->status == 'refunded') {
                                            $orderStatus = '4';
                                        }
                                        if ($value->status == 'any') {
                                            $orderStatus = '5';
                                        }
                                        if ($value->status == 'trash') {
                                            $orderStatus = '6';
                                        }
                                        if ($value->status == 'auto-draft') {
                                            $orderStatus = '7';
                                        }
                                        if ($value->status == 'pending') {
                                            $orderStatus = '8';
                                        }
                                        if ($value->status == 'cancelled') {
                                            $orderStatus = '9';
                                        }
                                        if ($value->status == 'failed') {
                                            $orderStatus = '10';
                                        }
                                        if ($value->status == 'checkout-draft') {
                                            $orderStatus = '11';
                                        }
                                        Order::updateOrCreate(
                                            [
                                                'order_id' => $value->id,
                                                'order_key' => $value->order_key
                                            ],
                                            [
                                                "id" => $value->id,
                                                "auth_id" => $customerID,
                                                "user_id" => $customerID,
                                                'order_status' => $orderStatus,
                                                'prices_include_tax' => $priceIncTax,
                                                'created_at' => $value->date_created,
                                                'updated_at' => $value->date_modified,
                                                'shipping_address_id' => $shippingID,
                                                'billing_address_id' => $billingID,
                                                'shipping_total' => $value->shipping_total,
                                                'discount_total' => $value->discount_total,
                                                'amount' => $value->total,
                                                'total_tax' => $value->total_tax,
                                                'payment_method' => $value->payment_method,
                                                'payment_method_title' => $value->payment_method_title,
                                                'transaction_id' => $value->transaction_id,
                                                'customer_ip_address' => $value->customer_ip_address,
                                                'customer_user_agent' => $value->customer_user_agent,
                                                'customer_note' => $value->customer_note,
                                                'created_via' => $value->created_via,
                                                'payment_status' => $paymentStatus,
                                            ]
                                        );
                                        if ($value->cart_tax != "0.00") {
                                            OrderCharge::create([
                                                "name" => 'cart',
                                                "type" => 'tax',
                                                "charge" => $value->cart_tax,
                                                "order_id" => $value->id,
                                            ]);
                                        }
                                        if ($value->shipping_total != "0.00") {
                                            OrderCharge::create([
                                                "name" => 'shipping',
                                                "type" => 'shipping',
                                                "charge" => $value->shipping_total,
                                                "order_id" => $value->id,
                                            ]);
                                        }

                                        if ($value->discount_total != "0.00") {
                                            OrderCharge::create([
                                                "name" => 'discount',
                                                "type" => 'discount',
                                                "charge" => $value->discount_total,
                                                "order_id" => $value->id,
                                            ]);
                                        }
                                        foreach ($value->line_items as $key2 => $value2) {
                                            OrderItem::updateOrCreate(
                                                [
                                                    'id' => $value2->id,
                                                    'product_id' => $value2->product_id
                                                ],
                                                [
                                                    "order_id" => $value->id,
                                                    'variation_id' => $value2->variation_id,
                                                    'quantity' => $value2->quantity,
                                                    'tax_class' => $value2->tax_class,
                                                    'subtotal' => $value2->subtotal,
                                                    'subtotal_tax' => $value2->subtotal_tax,
                                                    'total' => $value2->total,
                                                    'total_tax' => $value2->total_tax,
                                                    'real_price' => $value2->price,
                                                    'sell_price' => $value2->price,
                                                ]
                                            );
                                        }
                                    } else {
                                        print_r($productNotFound);
                                        \Log::info('Product not found ' . json_encode($productNotFound));
                                    }
                                }
                            }
                        }
                    }
                    $this->info('Orders migrated successfully.');
                    break;

                case 'product':
                    $Id = ['13112', '10511', '10555', '6156', '39777', '12066', '47560', '46289','3517','1460','8473'];
                    // [47560]; 12712, 15002 12703 12694 12652 1499
                    // foreach ($Id as $key => $value) {
                        // $this->info($value);
                        $singleProduct[] = $this->wooCommerceClientCall('wc/v3', 'products/' . '12668');
                        if ($singleProduct) {
                            $creratedProduct = $this->createOrUpdateProduct($singleProduct);

                            if($creratedProduct){
                                $singleProduct = collect($singleProduct)->first();
                                if ($singleProduct->type == "variable") {
                                    if (count($singleProduct->attributes) > 0) {
                                        $createdAttributes = $this->createOrUpdateProductAttribute($singleProduct);
                                        if ($createdAttributes) {
                                            if (count($singleProduct->variations) > 0) {
                                                $createdVariations = $this->createOrUpdateProductVariations($singleProduct);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $this->info(json_encode($singleProduct));
                        $this->info('completed');
                    // }

                    break;

                default:
                    $this->error('Invalid Param');
                    break;
            }
            return 'ASDASDSAD';
        } catch (\Exception $ex) {
            dd($ex);
            \Log::error($ex);
            $this->error($ex->getMessage());
            return;
        }
    }

    private function wooCommerceClientCall($version, $endpoint, $page = 1, $per_page = 50)
    {
        try {
            $url = 'http://dnzproducts.c247.website/';
            $consumerKey = "ck_242cf0101c2e65461e9aabd11c4f2f9f7278728f";
            $consumerSecret = "cs_1bc51da950889a70ca30c6ae2881ab356d9eed9f";
            $woocommerce = new Client(
                $url,
                $consumerKey,
                $consumerSecret,
                [
                    'version' => $version,
                    'timeout' => 1200000
                ]
            );
            $parameters = [
                'per_page' => $per_page,
                'page' => $page,
                'customer_id' => 0
            ];
            $response = $woocommerce->get($endpoint, $parameters);
            return $response;
        } catch (\Exception $ex) {
            dd($ex);
            \Log::error($ex);
            return false;
        }
    }

    private function createOrUpdateProduct($singleProduct)
    {
        try {

            $singleProduct = collect($singleProduct)->first();
            // return  $singleProduct->id;
            $productName = trim(strip_tags($singleProduct->name));
            $brand = NULL;
            if (str_contains($productName, '-')) {
                $productNameArr = explode('-', $productName);
                if (is_array($productNameArr)) {
                    $key = count($productNameArr);
                    $brandName = $productNameArr[$key - 1];

                    $checkBrand = Brand::where('name', $brandName)->first();
                    if ($checkBrand) {
                        $brand = $checkBrand->id;
                    }
                }
            }
            $product = Product::updateOrCreate(
                [
                    'name' => $productName,
                    'slug' => $singleProduct->slug,
                    'sku' => $singleProduct->sku,
                ],
                [
                    "id" => $singleProduct->id,
                    'type' => ($singleProduct->type == 'variable') ? 2 : 1,
                    'category_id' => isset($singleProduct->categories[0]) ? $singleProduct->categories[0]->id : 426, //426 -> Uncategorised Product Category ID
                    'description' => $singleProduct->description,
                    'regular_price' => ($singleProduct->type == 'variable') ? NULL : $singleProduct->regular_price,
                    'sale_price' => ($singleProduct->type == 'variable') ? NULL : $singleProduct->price,
                    'stock_status' => ($singleProduct->stock_status == 'instock') ? 'In stock' : 'Out of stock',
                    'product_information' => $singleProduct->description,
                    'additional_information' => $singleProduct->description,
                    'status' => 2,
                    'brand_id' => $brand,
                ]
            );
            if ($product) {
               
                $seo = SeoAnalysis::updateOrCreate([
                    'from' => 'Product',
                    'from_id' => $singleProduct->id,
                ],
                [
                    'title' => isset($singleProduct->yoast_head_json) ? strip_tags($singleProduct->yoast_head_json->title) : null,
                    'description' => isset($singleProduct->yoast_head_json->description) ? strip_tags($singleProduct->yoast_head_json->description) : null,
                    'meta_keywords' => strip_tags($singleProduct->slug)
                ]);
                if (count($singleProduct->categories) > 0) {
                    foreach ($singleProduct->categories as $singleCategory) {
                        ProductCategories::updateOrCreate([
                            'category_id' => $singleCategory->id,
                            'product_id' => $singleProduct->id
                        ], []);
                    }
                }

                if (count($singleProduct->images) > 0) {

                    $media = Media::where([
                        'model_id' => $singleProduct->id,
                        'model_type' => 'App\Models\Product'
                    ])->get();

                    if ($media->count() > 0) {
                        foreach ($media as $singleMedia) {
                            $deleteMedia = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($singleMedia->id);
                            $deleteMedia->delete();
                        }
                    }

                    foreach ($singleProduct->images as $keyImage => $singleImage) {
                        if ($keyImage == 0) {
                            $newFileName = 'DNZ-PRODUCT-' . Str::random(20) . '.jpg';
                            $product->addMediaFromUrl($singleImage->src)->usingFileName($newFileName)->toMediaCollection('featured_product_image');
                        } else {
                            $newFileName = 'DNZ-PRODUCT-' . Str::random(20) . '.jpg';
                            $product->addMediaFromUrl($singleImage->src)->usingFileName($newFileName)->toMediaCollection('product');
                        }
                    }
                }
            }
            return true;
        } catch (\Exception $ex) {
            \Log::error($ex);
            return $ex->getMessage();
        }
    }

    private function createOrUpdateProductAttribute($singleProduct)
    {
        try {
            foreach ($singleProduct->attributes as $singleAttribute) {

                $productAttributeVariations = NULL;
                $variations = [];
                if (count($singleAttribute->options) > 0) {
                    foreach ($singleAttribute->options as $singleOption) {
                        $checkVariation = Variation::where([
                            'attribute_id' => $singleAttribute->id,
                            'name' => $singleOption
                        ])->first();
                        if (empty($checkVariation)) {
                            $checkVariation = Variation::create([
                                'attribute_id' => $singleAttribute->id,
                                'name' => $singleOption,
                                'status' => '1',
                            ]);
                        }
                        if ($checkVariation) {
                            array_push($variations, $checkVariation->id);
                        }
                    }
                }

                if (count($variations)  > 0) {
                    $productAttributeVariations = '["' . implode('","', $variations) . '"]';

                    ProductAttribute::updateOrCreate(
                        [
                            'attribute_id' => $singleAttribute->id,
                            'product_id' => $singleProduct->id
                        ],
                        [
                            'variation_id' => $productAttributeVariations
                        ]
                    );
                }
            }
            return true;
        } catch (\Exception $ex) {
            \Log::error($ex);
            return $ex->getMessage();
        }
    }

    private function createOrUpdateProductVariations($singleProduct)
    {
        try {
            ProductVariation::where(['product_id' => $singleProduct->id])->delete();

            foreach ($singleProduct->variations as $singleVariation) {
                $checkProductVariation = $this->wooCommerceClientCall('wc/v3', 'products/' . $singleProduct->id . '/variations/' . $singleVariation);

                if ($checkProductVariation) {

                    if (count($checkProductVariation->attributes) > 0) {

                        $productVariationsArr = [];

                        foreach ($checkProductVariation->attributes as $key => $singleAttributVariation) {

                            $checkVariation = Variation::where([
                                'attribute_id' => $singleAttributVariation->id,
                                'name' => $this->cleanName($singleAttributVariation->option),
                            ])->first();

                            if (empty($checkVariation)) {
                                $checkVariation = Variation::create([
                                    'attribute_id' => $singleAttributVariation->id,
                                    'name' => $this->cleanName($singleAttributVariation->option),
                                ]);
                            }

                            if ($checkVariation) {
                                array_push($productVariationsArr, $checkVariation->id);
                            }
                        }
                        if (!empty($productVariationsArr)) {
                            $productVariations = '["' . implode('","', $productVariationsArr) . '"]';
                            ProductVariation::create([
                                'id' => $checkProductVariation->id,
                                'product_id' => $singleProduct->id,
                                'sku' => $checkProductVariation->sku,
                                'variation_id' => $productVariations,
                                'sale_price' => ($checkProductVariation->price == "") ? "0.00" : $checkProductVariation->price,
                                'regular_price' => ($checkProductVariation->regular_price == "") ? "0.00" : $checkProductVariation->regular_price,
                                'status' => "1",
                                'stock_status' => ($singleProduct->stock_status == 'instock') ? 'In stock' : 'Out of stock',
                            ]);
                        }
                    }
                }
            }
            return true;
        } catch (\Exception $ex) {
            dd($ex);
            \Log::error($ex);
            return false;
        }
    }

    function cleanName($string)
    {
        return str_replace("&#8243;", '"', str_replace("&#8211;", "-", str_replace("&#215;", "x", str_replace("&amp;", "&", html_entity_decode($string, ENT_QUOTES, 'UTF-8')))));
    }
}
