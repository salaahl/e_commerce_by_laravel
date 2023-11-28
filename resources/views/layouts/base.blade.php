<!DOCTYPE html>
<html lang="fr">

<head>
    @yield('head')
    <meta charset="utf-8">
    <meta name="author" lang="fr" content="Salaha SOKHONA">
    <meta name="copyright" content="Salaha SOKHONA.">
    <meta name="description" content="Vente de parfums.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="antialiased">
    <header>
        @include('layouts.navigation')
        @yield('header')
    </header>
    @yield('main-content')
    @include('layouts.footer')
    <script src="{{ asset('js/active_page.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
</body>

</html>
