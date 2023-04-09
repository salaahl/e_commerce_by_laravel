<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            form 
            {
                background-color: beige;
            }
        </style>
    </head>
    <body class="antialiased">
        <h2>Catalogues : </h2>
        @foreach($catalogs as $catalog)
            <h3>{{ $catalog['catalog'] }}</h3>
        @endforeach
        <h2>Utilisateurs : </h2>
        @foreach($customers as $customer)
            <h3>{{ $customer['name'] }}, {{ $customer['surname'] }}</h3>
        @endforeach
        <h2>Produits : </h2>
        @foreach($products as $product)
            <h3>{{ $product['name'] }}, {{ $product['catalog_id'] }}</h3>
            <img src="/images/{{ $product['picture'] }}"/>
        @endforeach
    </body>
</html>