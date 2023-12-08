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
    //
    public function checkout(): View
    {
        return view('stripe/checkout');
    }

    //
    public function checkoutCustomPost(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        function calculateOrderAmount(array $items): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            return 1400;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 1000,
                'currency' => 'eur',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return response()->json([
                'clientSecret' => $output,
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }


    //
    public function checkoutPost(Request $request)
    {
        try {
            $APP_URL = env('APP_URL');
            $basket = Basket::where('user_email', auth()->user()->email)->get();

            if ($basket) {
                $total_price = 0;
                $items = [];

                foreach ($basket as $basket_item) {
                    $product = Product::where('reference', $basket_item->product_reference)->first();
                    $total_price += $product->price * $basket_item->quantity;
                    $items[] = [
                        'price_data' => [
                            'product_data' => [
                                'name' => $product->name,
                                'images' => [$APP_URL . '/images/' . $product->picture],
                            ],
                            // Prix (sans le séparateur, ex : 1000 = 10)
                            'unit_amount' => $product->price * 100,
                            'currency' => 'eur',
                        ],
                        'quantity' => $basket_item->quantity,
                    ];
                };

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                header('Content-Type: application/json');

                $checkout_session = $stripe->checkout->sessions->create([
                    'ui_mode' => 'embedded',
                    'line_items' => $items,
                    'mode' => 'payment',
                    'shipping_address_collection' => ['allowed_countries' => ['FR']],
                    'custom_text' => [
                        'shipping_address' => [
                            'message' => 'Please note that we can\'t guarantee 2-day delivery for PO boxes at this time.',
                        ],
                        'submit' => ['message' => 'We\'ll email you instructions on how to get started.'],
                    ],
                    'return_url' => $APP_URL . '/return',
                ]);

                http_response_code(200);

                return response()->json([
                    'clientSecret' => $checkout_session->client_secret,
                ]);
            } else {
                return redirect()->route('basket');
            }
        } catch (Exception $e) {
            http_response_code(500);

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }


    //
    public function status(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            header('Content-Type: application/json');

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
