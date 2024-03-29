<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Order;
use App\Models\Bill;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function home()
    {
        $bestsellers = Product::orderBy('name', 'DESC')->limit(2)->get();
        $product_featured = Product::orderBy('created_at', 'DESC')->first();
        $products_new = Product::orderBy('created_at', 'DESC')->limit(2)->get();

        return view(
            'pages/home',
            [
                "bestsellers" => $bestsellers,
                "product_featured" => $product_featured,
                "products_new" => $products_new
            ]
        );
    }

    /**
     * Handle the incoming request.
     */
    public function profile()
    {
        $bills = Bill::where('email', auth()->user()->email)->orderBy('created_at', 'DESC')->get();
        $orders = [];
        foreach ($bills as $bill) {
            $orders[] = Order::where('index_id', $bill->order_index)->orderBy('created_at', 'DESC')->get();
        }

        return view(
            'pages/profile',
            [
                "user" => auth()->user(),
                "bills" => $bills,
                "orders" => $orders
            ]
        );
    }
}
