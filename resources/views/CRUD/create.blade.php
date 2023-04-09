<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Studients</title>

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
        <form method="GET" action="{{url('/CRUD/store')}}">
            @csrf
            <h1>Catalog</h1>
            <label for="name">Catalog :</label>
            <input type="text" id="catalog_name" name="catalog_name"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input name="form" type="hidden" value="catalog">
        </form>

        <form method="GET" action="{{url('/CRUD/store')}}">
            @csrf
            <h1>Customer</h1>
            <label for="name">First name :</label>
            <input type="text" id="customer_name" name="customer_name"><br><br>
            <label for="surname">Last name :</label>
            <input type="text" id="customer_surname" name="customer_surname"><br><br>
            <label for="address">Address :</label>
            <input type="text" id="customer_address" name="customer_address"><br><br>
            <label for="mail">Mail :</label>
            <input type="email" id="customer_mail" name="customer_mail"><br><br>
            <label for="phone">Phone :</label>
            <input type="tel" id="customer_phone" name="customer_phone"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input name="form" type="hidden" value="customer">
        </form>

        <form method="GET" action="{{url('/CRUD/store')}}">
            @csrf
            <h1>Product</h1>
            <label for="name">Name :</label>
            <input type="text" id="product_name" name="product_name"><br><br>
            <label for="catalog">Catalog :</label>
            <input type="text" id="product_catalog" name="product_catalog"><br><br>
            <label for="reference">Reference :</label>
            <input type="text" id="product_reference" name="product_reference"><br><br>
            <label for="product_description">Description :</label>
            <textarea id="product_description" name="product_description"></textarea><br><br>
            <label for="product_picture">Picture :</label>
            <input type="file"
                id="product_picture" name="product_picture"
                accept="image/png, image/jpeg, image/svg"><br><br>
            <label for="stock">Stock :</label>
            <input type="number" id="product_stock" name="product_stock"><br><br>
            <label for="price">Price :</label>
            <input type="text" id="product_price" name="product_price"><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input name="form" type="hidden" value="product">
        </form>
    </body>
</html>