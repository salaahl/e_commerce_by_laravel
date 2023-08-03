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
        @if(isset($articles))
        @foreach($articles as $article)
        <div class="article">
            <div class="img-container">
                <a href="{{ '/articles/' . $article[0]->reference }}">
                    <img src="{{ asset('images/' . $article[0]->picture) }}" />
                </a>
            </div>
            <div class="content">
                <div class="description">
                    <h3>{{ $article[0]->name }}</h3>
                    <h3>{{ $article[0]->price }}€</h3>
                </div>
                <div class="options">
                    <div>
                        <h4>Quantité :</h4>
                        <select name="quantity" class="quantity">
                            <option value="{{ $quantity[$index] }}" selected>{{ $quantity[$index] }}</option>
                            @for ($i = 1; $i <= $article[0]->stock; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <form class="delete-article">
                            @csrf
                            <button type="submit">Supprimer du panier</button>
                            <input name="reference" type="hidden" value="{{ $article[0]->reference }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @php
        $total += $article[0]->price * $quantity[$index];
        $index++;
        @endphp
        @endforeach
        @else
        <div>Code à exécuter si le panier ne contient aucun article.</div>
        @endif
    </main>
    <aside>
        <div id="total">
            <h2>Total : {{ $total }}€</h2>
        </div>
        <div id="customer">
            <h4>{{ $user->name }}</h4>
            <h4>{{ $user->surname }}</h4>
            <h4>{{ $user->address }}</h4>
            <h4>{{ $user->phone }}</h4>
            <h4>{{ $user->email }}</h4>
        </div>
        <form method="GET" action="{{url('/order')}}">
            @csrf
            <button class="button-stylised" type="submit">Commander</button>
        </form>
    </aside>
</div>
<script src="{{ asset('js/basket.js') }}"></script>
@endsection
