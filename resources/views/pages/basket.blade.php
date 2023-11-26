@extends('layouts.base')

@section('head')
@parent
@section('title', 'Panier')
<link href="{{ asset('css/basket.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h1>Votre panier</h1>
<div class="global-container">
    <main>
        @php
        $index = 0;
        $total = 0;
        @endphp
        @if(isset($products))
        @foreach($products as $product)
        <article class="product">
            <section class="img-container">
                <a href="{{ '/products/' . $product[0]->reference }}">
                    <img src="{{ asset('images/' . $product[0]->picture) }}" />
                </a>
            </section>
            <section class="content">
                <div class="description">
                    <h3>{{ $product[0]->name }}</h3>
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
        @else
        <div>Code à exécuter si le panier ne contient aucun article.</div>
        @endif
    </main>
    <aside>
        <section id="total">
            <h3>Total : {{ $total }}€</h3>
        </section>
        <section id="customer">
            <h4>{{ $user->name }}</h4>
            <h4>{{ $user->surname }}</h4>
            <h4>{{ $user->address }}</h4>
            <h4>{{ $user->phone }}</h4>
            <h4>{{ $user->email }}</h4>
        </section>
        <form method="GET" action="{{url('/order')}}">
            @csrf
            <button class="button-stylised" type="submit">Commander</button>
        </form>
    </aside>
</div>
<script src="{{ asset('js/basket.js') }}"></script>
@endsection
