<!DOCTYPE html>
<html>

<head>
    <title>Thanks for your order!</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/return.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/return.js') }}" defer></script>
</head>

<body>
    <section id="success" class="hidden">
        <p>
            We appreciate your business! A confirmation email will be sent to <span id="customer-email"></span>.

            If you have any questions, please email <a href="mailto:orders@example.com">orders@example.com</a>.
        </p>
    </section>
</body>

</html>