<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionController extends Controller
{
      /**
     * 
     *initialized constructor for permission's.
     * 
     */
    public function __construct()
    {
        $this->middleware('permission:list-transaction', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.transaction.index');

        // try{
        //   if(\Cache::has('transactionData')){
        //     $transactionRecord = \Cache::get('transactionData');
        //     $transactions =  $this->paginate(collect($transactionRecord->autoPagingIterator())->toArray())->withPath('/projection-booth/transaction');
        //     return view('backend.transaction.index',compact('transactions'));
        //   }
        //     // fetch data from api 
        //     $stripeTransaction = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //     $transactionRecord =   $stripeTransaction->balanceTransactions->all(['limit' => 100]);
        //     $transactions =  $this->paginate(collect($transactionRecord->autoPagingIterator())->toArray())->withPath('/projection-booth/transaction');
        //     \Cache::Put('transactionData', $transactionRecord, now()->addMinute(10));
        //     return view('backend.transaction.index',compact('transactions'));
        // }catch(\Exception $ex){
        //     \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        // }
    }

    public function paginate($items, $perPage = 20, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
   
}
