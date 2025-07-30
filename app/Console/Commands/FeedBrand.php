<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Console\Command;

class FeedBrand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:brand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Brand in product';

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
        $allProduct = Product::get();

        foreach ($allProduct as $key => $product) {
            if(strpos($product["name"],'-')) {
                $brandName = trim(explode('-',$product["name"])[1]," ");
                $brand = Brand::where("slug",\Str::slug($brandName))->first();
                if(empty($brand)) {
                        $brand = Brand::create([
                            'name' => $brandName,
                            'slug' => \Str::slug($brandName),
                            'status' => '1',
                        ]);
                }
                $product->update([
                    'brand_id' => $brand['id']
                ]);
            }
        }
        $this->info('updated successfully!');
    }
}
