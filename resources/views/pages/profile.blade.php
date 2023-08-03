@extends('layouts.base')

@section('head')
@parent
@section('title', 'Profile')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h1>Mon profil</h1>
<main>
    <div class="mx-auto">
        <div class="overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="profile">
                <a href="/profile">Modifier mes informations</a>
            </div>
        </div>
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                Historique de mes commandes :
                @foreach($bills as $bill)
                <div class="bill">
                    <h3>Facture numéro {{ $bill->id }}</h3>
                    <br>
                    Articles commandés :
                    <br>
                    @php($i = 0)
                    @foreach($orders as $order)
                    @if(isset($order[$i]->index_id) && $order[$i]->index_id === $bill->order_index)
                    <div class="article">
                        - Référence : {{ $order[$i]->product_reference }}
                        <br>
                        - Quantité : {{ $order[$i]->quantity }}
                        <br>
                    </div>
                    @php($i++)
                    @endif
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection