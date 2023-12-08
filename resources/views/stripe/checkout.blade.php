<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Paiement</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Page de paiement" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}" defer></script>
</head>

<body>
    <!-- Display a payment form -->
    <form id="payment-form">
        <input type="text" id="email" placeholder="Enter email address" />
        <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
        </div>
        <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay now</span>
        </button>
        <div id="payment-message" class="hidden"></div>
    </form>
</body>

</html>