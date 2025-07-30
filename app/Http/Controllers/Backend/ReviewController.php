<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        try {
            $reviews = Review::with('user', 'product');
            $flag = '';
            /* === FILTER SHORT BY === */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $reviews = $reviews->oldest();
                }elseif($sortBy == '2'){
                    $reviews = $reviews->latest();
                }else{

                }
            }
            /* === FILTER RATING === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss <= '5'){
                    $reviews = $reviews->where('rating', $request->ss);
                }else{

                }
            }
            $reviews = $reviews->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.review.index', compact('reviews', 'flag'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show($id){
        try {
            $review = Review::with('user', 'product')->find($id);
            $reviewModel = view('backend.review.include.detail',compact('review'))->render();
            return response()->json([ 'status' => 'success', 'output' => $reviewModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function reviewStatus($id){
        try {
            $status = Review::where('id', $id)->first()->status;
            $review['status'] = $status ? '0' : '1';
            $review['id'] = $id;
            Review::where('id', $id)->update([ 'status' => $review['status'] ]);
            $reviewStatus = view('backend.review.include.status', compact('review'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully', 'output' => $reviewStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}