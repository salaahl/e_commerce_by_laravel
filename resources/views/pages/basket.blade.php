@extends('layouts.base')

@section('head')
@parent
@section('title', 'Panier')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/basket.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h1>Votre panier</h1>
<div class="global-container">
    <main>
        @if(isset($products))
        @php
        $index = 0;
        $total = 0;
        @endphp
        @foreach($products as $product)
        <article class="product">
            <section class="img-container">
                <a href="{{ '/products/' . $product[0]->reference }}">
                    <img src="{{ asset('images/' . $product[0]->picture) }}" />
                </a>
            </section>
            <section class="content">
                <div class="description">
                    <h3 class="title">{{ $product[0]->name }}</h3>
                    <h3 class="price">{{ $product[0]->price }}€</h3>
                </div>
                <div class="options">
                    <div>
                        <h4>Quantité :</h4>
                        <select name="quantity" class="quantity">
                            <option value="{{ $quantity[$index] }}" selected>{{ $quantity[$index] }}</option>
                            @for ($i = 1; $i <= $product[0]->stock; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div>
                        <form class="delete-product">
                            @csrf
                            <button type="submit">Supprimer du panier</button>
                            <input name="reference" type="hidden" value="{{ $product[0]->reference }}">
                        </form>
                    </div>
                </div>
            </section>
        </article>
        @php
        $total += $product[0]->price * $quantity[$index];
        $index++;
        @endphp
        @endforeach
    </main>
    <aside>
        <section id="total">
            <h3>Total : {{ $total }}€</h3>
        </section>

        <!-- Display a payment form -->
        <form id="payment-form">
            <!--Stripe.js injects the Payment and Address Element-->
            <div id="address-element"></div>
            <div id="payment-element"></div>
            <button id="submit" class="button-stylised" style="display: none;">
                <div class="spinner hidden" id="spinner"></div>
                <span id="button-text">Pay now</span>
            </button>
            <div id="payment-message" class="hidden"></div>
        </form>
        <button id="show-payment-form" class="button-stylised">Payer</button>
    </aside>
    @else
    <div>Code à exécuter si le panier ne contient aucun article.</div>
    @endif
</div>
<script src="{{ asset('js/basket.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/checkout.js') }}" defer></script>
@endsection
