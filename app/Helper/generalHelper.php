<?php

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};

function paginatePage($data,$key)
{
    return $key+1 + ( (($_GET['page'] ?? 1) - 1 ) * $data->perPage() );
    
}

function sku()
{
    return IdGenerator::generate([
        'table' => 'products',
        'field' => 'sku',
        'length' => 8,
        'prefix' => 'DNZ000',
        'reset_on_prefix_change' => true,
    ]);
} 
function skuVariation()
{
    return IdGenerator::generate([
        'table' => 'product_variations',
        'field' => 'sku',
        'length' => 7,
        'prefix' => 'DNZ',
        'reset_on_prefix_change' => true,
    ]);
} 
//invoice Id Generate
function invoiceID()
{
    return IdGenerator::generate([
        'table' => 'bookings',
        'field' => 'invoice_id',
        'length' => 8,
        'prefix' => 'DC',
        'reset_on_prefix_change' => true,
    ]);
} 

//invoice Id Generate
function orderNumber()
{
    return IdGenerator::generate([
        'table' => 'orders',
        'field' => 'order_id',
        'length' => 7,
        'prefix' => 'Dnz',
        'reset_on_prefix_change' => true,
    ]);
} 

function orderNumberHelper(){
    if(session()->has('order_number')){
        session()->forget('order_number');
    }
}

/*
*
*   function fileContentRead
*   return file data 
*/ 
function fileContentRead($path){
    return \File::get($path);
}

/* === State === */
function getUsState() {
    return json_decode(fileContentRead(public_path('/json/us-state.json')));
}

/* === PRODUCT ALL POSSIBLE VARIATIONS === */
function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }

    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ? array_merge(array($v), $t) : array($v, $t);
        }
    }

    return $result;
}

/* === FAQ Category === */
function getFaqCategory() {
    return ['DNZ Scope Mount & Mounting Accessories Info',' Other DNZ Products','General Info', "FAQ's"];
}

/**
 * get custom pagination function
 *
 * @param [array] $items
 * @param integer $perPage
 * @param [int, null] $page
 * @param array $options
 * @return void
 */
function paginate($items, $perPage = 90,$path = null , $page = null, $options = []) {
    
    // $perPage = config('app.paginate');
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // return $path;
    $paginator->appends($path);
    return $paginator;
}