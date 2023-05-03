<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Bill;

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
        return view('pages/profile', [
                "user" => auth()->user(),
                "bills" => Bill::where('user_email', auth()->user()->email)->orderBy('created_at', 'DESC')->get()
             ]
        );
    }
}
