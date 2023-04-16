<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function articles(Request $request)
    {
        $articles = Product::paginate(9);
        // $articles_by = Product::orderBy('name', 'desc')->paginate(9);

        return view('pages/articles', [
            "articles" => $articles
        ]);
    }

    public function article(Request $request, $slug)
    {
        $article = Product::where('reference', $slug)->first();

        return view('pages/article', [
            "article" => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $article = Product::where('reference', $request->reference)->first();
        $article->quantity = $article->quantity - $request->quantity;
        $article->save();
    }
}
