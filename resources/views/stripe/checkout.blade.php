<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Payement</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Page de payement" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}" defer></script>
</head>

<body>
    <!-- Display a payment form -->
    <div id="checkout">
        <!-- Checkout will insert the payment form here -->
    </div>
</body>

</html>
