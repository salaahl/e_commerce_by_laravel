@extends('layouts.base')

@section('head')
@parent
@section('title', 'Products')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h1>Produits : </h1>
@foreach($products as $product)
<div class="product">
    <form class="form" method="GET" action="{{url('/CRUD/update')}}">
        @csrf
        <p class="field required">
            <label>Catalogue :</label>
            <input type="text" name="catalog" class="text-input" value="{{ $product['catalog'] }}" readonly>
        </p>
        <p class="field required">
            <label>Référence :</label>
            <input type="text" name="reference" class="text-input" value="{{ $product['reference'] }}" readonly>
        </p>
        <p class="field required">
            <label>Nom :</label>
            <input type="text" name="name" class="text-input" value="{{ $product['name'] }}" readonly>
        </p>
        <p class="field required">
            <label for="product-stock">Stock :</label>
            <input type="number" name="stock" class="text-input" value="{{ $product['stock'] }}">
        </p>
        <button class="button" type="submit">Mettre à jour le stock</button>
    </form>
</div>
@endforeach
@endsection
