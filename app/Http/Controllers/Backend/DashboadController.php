<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, Category, Attribute, Product, Order, Blog, Dealer};

class DashboadController extends Controller{
    /**
    *
    *Function to show first page of the website.
    *
    */
    public function index(){
        try {
            $blogs = Blog::count();
            $order = Order::latest();
            $orders = $order->count();
            $dealers = Dealer::count();
            $products = Product::count();
            $categories = Category::count();
            $attributes = Attribute::count();
            $totalSale = $order->sum('amount');
            $customers = User::role('user')->get();
            $adminName = Auth::guard('admin')->user()->first_name;
            $customerList = User::role('user')->orderBy('updated_at', 'DESC')->take(5)->get();
            $orderList = $order->with("customer")->orderBy('updated_at', 'DESC')->take(5)->get();
            $last7DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(7))->pluck('amount')->sum();
            $last30DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(30))->pluck('amount')->sum();
            $last365DaysTransaction = Order::where('created_at','>=',todayDate()->subDays(365))->pluck('amount')->sum();
            return view('welcome', compact('adminName','totalSale','customers', 'customerList', 'categories', 'attributes', 'products', 'orders', 'blogs', 'dealers', 'orderList', 'last7DaysTransaction', 'last30DaysTransaction', 'last365DaysTransaction'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}