<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Bill;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $basket = Basket::where('user_id', auth()->user()->id)
            ->where('product_id', Product::where('reference', $slug)->first()->id)
            ->first();

        if ($basket) {
            $this->update($request, $basket);
        } else {
            $basket = new Basket;
            $basket->user_id = auth()->user()->id;
            $basket->product_id = Product::where('reference', $slug)
                ->first()
                ->id;
            $basket->quantity = $request->quantity;
            $basket->save();
        }

        $this->show();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $articles = [];
        $quantity = [];
        $baskets = Basket::where('user_id', auth()->user()->id)->get();

        foreach ($baskets as $basket) {
            $articles[] = Product::where('id', $basket->product_id)->get();
            $quantity[] = $basket->quantity;
        }

        return view('pages/basket', [
            "user" => auth()->user(),
            "articles" => $articles,
            "quantity" => $quantity
        ]);
    }

    public function order(Basket $basket)
    {
        /*
        $baskets = Basket::where('user_id', auth()->user()->id)->get();
        $order = new Order();
        $order->user_id = $basket->user_id;

        foreach ($baskets as $basket) {
            $order->product_id .= ',' . $basket->product_id;
        }

        $order->save();

        $bill = new Bill();
        $bill->order_id =;
        $bill->name =;
        $bill->surname =;
        $bill->address =;
        $bill->email =;
        $bill->phone =;
        $bill->total_price =;

        $this->destroy($baskets);

        return view('pages/order');
        */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Basket $basket)
    {
        $basket->quantity = $basket->quantity + $request->quantity;
        $basket->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Basket $basket)
    {
        $basket->delete();
    }
}
