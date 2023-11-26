<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Catalog;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        switch ($request->form) {
            case "catalog":
                $catalog = new Catalog;
                $catalog->catalog = $request->name;
                $catalog->save();
                break;
            case "product":
                $product = new Product;
                $product->name = $request->name;
                $product->catalog =
                    Catalog::where('catalog', $request->catalog)
                    ->first()
                    ->catalog;
                $product->reference = $request->reference;
                $product->description = $request->description;
                $product->picture = $request->picture;
                $product->stock = $request->stock;
                $product->price = $request->price;
                $product->save();
                break;
        }
    }

    /**
     * Handle the incoming request.
     */
    public function products(Request $request)
    {
        $products = null;

        switch ($request->order) {
            case "new":
                $products = Product::orderBy('created_at', 'ASC')->paginate(9);
                break;
            case "price":
                $products = Product::orderBy('price', 'ASC')->paginate(9);
                break;
            case "rating":
                $products = Product::orderBy('rating', 'DESC')->paginate(9);
                break;
            case "bestseller":
                $products = Product::orderBy('orders', 'DESC')->paginate(9);
                break;
            default:
                $products = Product::paginate(9);
        }

        return view('pages/products/list', [
            "products" => $products
        ]);
    }

    public function product(Request $request, $slug)
    {
        $product = Product::where('reference', $slug)->first();

        return view('pages/products/product', [
            "product" => $product
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function manage()
    {
        $products = Product::orderBy('name')->paginate(10);

        return view('pages/products/manage', [
            "products" => $products
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $product = Product::where('reference', $request->reference)->first();

        $product->catalog = Catalog::where('catalog', $request->catalog)->first()->catalog;
        $product->reference = $request->reference;
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Basket $basket,
        Bill $bill,
        Catalog $catalog,
        Order $order,
        Product $product
    ) {
        $product = Product::where('reference', $request->reference)->first();

        $product->delete();
    }
}
