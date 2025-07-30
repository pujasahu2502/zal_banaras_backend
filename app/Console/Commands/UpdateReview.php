<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Console\Command;

class UpdateReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $allProduct = Product::withAvg('reviews as avgRating','rating')->get();
        foreach ($allProduct as $key => $value) {
            $this->info($key+1);
            Product::where('id',$value->id)->update([         
                   'avg_rating' => $value['avgRating']
            ]);
        }
    }
}
