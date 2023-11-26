<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Index;
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
    public function store(Request $request)
    {
        $product = Product::where('reference', $request->reference)->first();
        $basket = Basket::where('user_email', auth()->user()->email)
            ->where('product_reference', $product->reference)
            ->first();

        if ($basket) {
            $basket->quantity = $request->quantity;
        } else {
            $basket = new Basket;
            $basket->user_email = auth()->user()->email;
            $basket->product_reference = $product->reference;
            $basket->quantity = $request->quantity;
        }
        $basket->save();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::where('email', auth()->user()->email)->get()->first();
        $baskets = Basket::where('user_email', $user->email);
        
        $products = [];
        $quantity = [];
        $baskets = Basket::where('user_email', auth()->user()->email)->get();

        foreach ($baskets as $basket) {
            $products[] = Product::where('reference', $basket->product_reference)->get();
            $quantity[] = $basket->quantity;
        }

        return view('pages/basket', [
            "user" => auth()->user(),
            "products" => $products,
            "quantity" => $quantity
        ]);
    }

    public function order()
    {
        $user = User::where('email', auth()->user()->email)->get()->first();
        $baskets = Basket::where('user_email', $user->email);

        $index = new Index();
        $index->save();

        foreach ($baskets->get() as $basket) {
            $order = new Order();
            $order->index_id = $index->id;
            $order->user_email = $basket->user_email;
            $order->product_reference = $basket->product_reference;
            $order->quantity = $basket->quantity;
            $order->save();
            $product = Product::where('reference', $basket->product_reference);
            $product->update([
                'stock' => $product->first()->stock - $basket->quantity
            ]);
        }

        foreach ($baskets->get() as $basket) {
            $bill = new Bill();
            $bill->order_index = $index->id;
            $bill->name = $user->name;
            $bill->surname = $user->surname;
            $bill->address = $user->address;
            $bill->email = $user->email;
            $bill->phone = $user->phone;
            $bill->total = Product::where('reference', $basket->product_reference)->first()->price * $basket->quantity;
            $bill->save();
        }

        $baskets->delete();

        return redirect()->route('confirmation', [
            'slug' => $index->id
        ]);           
    }

    public function confirmation($slug)
    {
        $bill = Bill::where('order_index', $slug)
        ->where('email', auth()->user()->email)
        ->first();

        return view('pages/confirmation', [
            'bill' => $bill
        ]);
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
    public function update(Request $request)
    {
        $basket = Basket::where('user_email', auth()->user()->email)
            ->where('product_reference', Product::where('reference', $request->reference)->first()->reference)
            ->first();
        $basket->quantity = $request->quantity;
        $basket->save();

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Basket::where('product_reference', Product::where('reference', $request->reference)->get()->first()->reference)
            ->where('user_email', auth()->user()->email)
            ->delete();
    }
}
