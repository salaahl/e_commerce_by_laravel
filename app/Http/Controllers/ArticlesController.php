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
        $articles = null;
        
        switch ($request->order) {
            case "new":
                $articles = Product::orderBy('created_at', 'ASC')->paginate(9);
                break;
            case "price":
                $articles = Product::orderBy('price', 'ASC')->paginate(9);
                break;
            case "rating":
                $articles = Product::orderBy('rating', 'DESC')->paginate(9);
                break;
            case "bestseller":
                $articles = Product::orderBy('orders', 'DESC')->paginate(9);
                break;
            default:
                $articles = Product::paginate(9);
        }
        
        if(1 == 2) {
            // Je peux imaginer un tri par 'nouveauté' (en utilisant le timestramp 'created_at'), prix, notes (ajouter une colonne voir une table ds ce cas)
            // Pour le catalogue je n'ai qu'à trier en 'requêtant' de la sorte : Product::where('catalog', 'Homme')->paginate(9);
            $articles = Product::orderBy('$request->column', $request->order)->paginate(9);
            return response()->json(['articles' => $articles]);
        }

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
