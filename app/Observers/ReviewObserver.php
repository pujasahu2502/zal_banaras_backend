<?php

namespace App\Observers;
use App\Models\{Product, Review};

class ReviewObserver
{
    /**
     * Handle the Webinar "updated" event.
     *
     * @param  \App\Models\Review  $webinar
     * @return void
     */
    public function created(Review $review)
    {
        // dd($review['product_id']);
        // $avg = Review::where('product_id',$review['product_id'])->avg('rating');
        // // dd($avg);
        // Product::where('id',$review['product_id'])->update([
        //     'avg_rating' => $avg
        // ]);
    }
}
