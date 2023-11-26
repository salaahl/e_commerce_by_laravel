@extends('layouts.base')

@section('head')
@parent
@php($product_name = $product->name)
@section('title', $product_name)
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<aside class="breadcrumb">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="/products" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Articles</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>
</aside>
<main>
    <div id="product-img-container">
        <img src="{{ asset('images/' . $product->picture) }}" alt="{{ $product->name }} picture"/>
    </div>
    <article id="product-container">
        <section id="product">
            <h3 id="name">{{ $product->name }}</h3>
            <h3 id="price">{{ $product->price }}€</h3>
            <p id="description">{{ $product->description }}</p>
        </section>
        <section id="product-order">
            @if (auth()->user())
            @if ($product->stock === 0)
            <h4 style="color: red">Cet article n'est plus en stock</h4>
            <form method="GET" action="{{url('/')}}">
                @csrf
                <button class="button-stylised" type="submit" disabled>Etre notifié de sa disponibilité</button>
            </form>
            @else
            <form id="add-basket">
                @csrf
                <label for="quantity">Quantité :</label>
                <select name="quantity" id="quantity">
                    @for ($i = 1; $i <= $product->stock; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
                <button class="button-stylised" type="submit">Ajouter au panier</button>
                <input name="reference" id="reference" type="hidden" value="{{ $product->reference }}">
            </form>
            @endif
            @else
            <h4 style="color: red;">Veuillez vous connecter pour accéder au statut de cet article.</h4>
            <form method="GET" action="{{url('/login')}}">
                @csrf
                <button class="button-stylised" type="submit">Se connecter</button>
            </form>
            @endif
        </section>
    </article>
</main>
<script src="{{ asset('js/product.js') }}"></script>
@endsection
