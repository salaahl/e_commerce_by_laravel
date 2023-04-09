<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Bill;
use App\Models\Catalog;
use App\Models\Customer;
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
            case "customer":
                $customer = new Customer;
                $customer->name = $request->customer_name;
                $customer->surname = $request->customer_surname;
                $customer->address = $request->customer_address;
                $customer->mail = $request->customer_mail;
                $customer->phone = $request->customer_phone;
                $customer->save();
                break;
            case "product":
                $product = new Product;
                $product->name = $request->product_name;
                $product->catalog_id = 
                Catalog::where('catalog', $request->product_catalog)
                ->first()
                ->id;
                $product->reference = $request->product_reference;
                $product->description = $request->product_description;
                $product->picture = $request->product_picture;
                $product->stock = $request->product_stock;
                $product->price = $request->product_price;
                $product->save();
                break;
        }

        return $this->show();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $catalogs = Catalog::all();
        $customers = Customer::all();
        $products = Product::all();

        return view('CRUD/read', [
            "catalogs" => $catalogs,
            "customers" => $customers,
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
        Customer $customer,
        Order $order,
        Product $product)
    {
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
        Customer $customer,
        Order $order,
        Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Basket $basket,
        Bill $bill,
        Catalog $catalog,
        Customer $customer,
        Order $order,
        Product $product
    )
    {
        //
    }
}