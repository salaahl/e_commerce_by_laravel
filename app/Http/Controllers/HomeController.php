<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function home()
    {
        return view('pages/home');
    }
    
    /**
     * Handle the incoming request.
     */
    public function profile()
    {
        return view('pages/profile');
    }
}
