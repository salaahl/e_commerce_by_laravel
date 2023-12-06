<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\Models\Basket;
use App\Models\Product;


class StripePaymentController extends Controller
{
    public function checkout(): View
    {
        return view('stripe/checkout');
    }

    public function checkoutPost(Request $request)
    {
        try {
            $basket = Basket::where('user_email', auth()->user()->email)->get();
            $total_price = 0;
            $total_quantity = 0;

            foreach ($basket as $product) {
                $quantity = $product->quantity;
                $price = Product::where('reference', $product->product_reference)->first()->price;

                $total_quantity += $quantity;
                $total_price += $price * $quantity;
            }

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            header('Content-Type: application/json');

            $YOUR_DOMAIN = 'http://127.0.0.1:8000';

            $checkout_session = $stripe->checkout->sessions->create([
                'ui_mode' => 'embedded',
                'line_items' => [[
                    'price_data' => [
                        'product_data' => [
                            'name' => 'Total :',
                        ],
                        // Prix (sans le séparateur, ex : 1100 = 11e)
                        'unit_amount' => filter_var($total_price, FILTER_SANITIZE_NUMBER_INT),
                        'currency' => 'eur',
                    ],
                    'quantity' => $total_quantity,
                ]],
                'mode' => 'payment',
                'return_url' => $YOUR_DOMAIN . '/return',
            ]);

            http_response_code(200);

            return response()->json([
                'clientSecret' => $checkout_session->client_secret,
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function status(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $session = $stripe->checkout->sessions->retrieve($jsonObj->session_id);

            http_response_code(200);

            return response()->json([
                'status' => $session->status,
                'customer_email' => $session->customer_details->email,
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function return()
    {
        return view(
            'stripe/return'
        );
    }
}
