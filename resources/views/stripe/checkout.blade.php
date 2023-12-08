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
      <h3>Contact info</h3>
      <div id="link-authentication-element"></div>
    
      <h3>Payment</h3>
      <div id="payment-element"></div>
    
      <button id="submit">Submit</button>
    </form>
</body>

</html>
