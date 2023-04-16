<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Bill;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CRUDController extends Controller
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
        return view('CRUD/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        switch ($request->form) {
            case "catalog":
                $catalog = new Catalog;
                $catalog->catalog = $request->catalog_name;
                $catalog->save();
                break;
            case "product":
                $product = new Product;
                $product->name = $request->product_name;
                $product->catalog =
                    Catalog::where('catalog', $request->product_catalog)
                    ->first()
                    ->catalog;
                $product->reference = $request->product_reference;
                $product->description = $request->product_description;
                $product->picture = $request->product_picture;
                $product->stock = $request->product_stock;
                $product->price = $request->product_price;
                $product->save();
                break;
        }

        // return $this->show();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $catalogs = Catalog::all();
        $products = Product::all();

        return view('CRUD/read', [
            "catalogs" => $catalogs,
            "products" => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Basket $basket,
        Bill $bill,
        Catalog $catalog,
        Order $order,
        Product $product
    ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Basket $basket,
        Bill $bill,
        Catalog $catalog,
        Order $order,
        Product $product
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Basket $basket,
        Bill $bill,
        Catalog $catalog,
        Order $order,
        Product $product
    ) {
        //
    }
}
