@extends('layouts.base')

@section('head')
@parent
@section('title', 'Products')
<link href="{{ asset('css/create_form.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h2>Produits : </h2>
@foreach($products as $product)
<div class="product">
    <span>Référence : {{ $product['reference'] }}</span>
    <span>Nom : {{ $product['name'] }}</span>
    <span>Catalogue : {{ $product['catalog'] }}</span>
    <span>
        <form method="GET" action="{{url('/CRUD/update')}}">
            @csrf
            <label for="product-stock">Stock :</label>
            <p class="field required">
                <input type="number" id="product-stock" name="stock" class="text-input" value="{{ $product['stock'] }}">
            </p>
            <button type="submit">Mettre à jour le stock</button>
        </form>
    </span>
</div>
@endforeach
@endsection
