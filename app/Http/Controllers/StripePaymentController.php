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
        try {
            $basket = Basket::where('user_email', auth()->user()->email)->get();

            if ($basket) {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $amount = 0;

                foreach ($basket as $basket_item) {
                    $product = Product::where('reference', $basket_item->product_reference)->first();
                    $amount += filter_var($product->price * $basket_item->quantity, FILTER_SANITIZE_NUMBER_INT);
                };

                header('Content-Type: application/json');

                // retrieve JSON from POST body
                $jsonStr = file_get_contents('php://input');
                $jsonObj = json_decode($jsonStr);

                // Create a PaymentIntent with amount and currency
                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => $amount,
                    'currency' => 'eur',
                ]);

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                    'user_name' => auth()->user()->name,
                    'user_surname' => auth()->user()->surname,
                    'user_address' => auth()->user()->address,
                    'user_email' => auth()->user()->email,
                    'total' => $product->price * $basket_item->quantity,
                ];

                return response()->json([
                    'output' => $output,
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
    public function checkoutPost(Request $request)
    {
        try {
            $APP_URL = env('APP_URL');
            $basket = Basket::where('user_email', auth()->user()->email)->get();

            if ($basket) {
                $items = [];

                foreach ($basket as $basket_item) {
                    $product = Product::where('reference', $basket_item->product_reference)->first();
                    $items[] = [
                        'price_data' => [
                            'product_data' => [
                                'name' => $product->name,
                                'images' => [$APP_URL . '/images/' . $product->picture],
                            ],
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
                            'message' => 'Comptez un délai de cinq jours ouvrés pour la livraison.',
                        ],
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

    //
    public function webhooks()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Replace this endpoint secret with your endpoint's unique secret
        // If you are testing with the CLI, find the secret by running 'stripe listen'
        // If you are using an endpoint defined with the API or dashboard, look in your webhook settings
        // at https://dashboard.stripe.com/webhooks
        $endpoint_secret = env('STRIPE_SECRET_ENDPOINT');
        
        $payload = @file_get_contents('php://input');
        $event = null;
        
        try {
          $event = \Stripe\Event::constructFrom(
            json_decode($payload, true)
          );
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
          echo '⚠️  Webhook error while parsing basic request.';
          http_response_code(400);
          exit();
        }
        if ($endpoint_secret) {
          // Only verify the event if there is an endpoint secret defined
          // Otherwise use the basic decoded event
          $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
          try {
            $event = \Stripe\Webhook::constructEvent(
              $payload, $sig_header, $endpoint_secret
            );
          } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            echo '⚠️  Webhook error while validating signature.';
            http_response_code(400);
            exit();
          }
        }
        
        // Handle the event
        switch ($event->type) {
          case 'payment_intent.succeeded':
            $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
            // Then define and call a method to handle the successful payment intent.
            // handlePaymentIntentSucceeded($paymentIntent);
            break;
          case 'payment_method.attached':
            $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
            // Then define and call a method to handle the successful attachment of a PaymentMethod.
            // handlePaymentMethodAttached($paymentMethod);
            break;
          default:
            // Unexpected event type
            error_log('Received unknown event type');
        }
        
        http_response_code(200);
    }
}
