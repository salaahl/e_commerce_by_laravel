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
        <aside class="overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="edit-profile">
                <a href="/profile">Modifier mes informations</a>
            </div>
        </aside>
        <section class="overflow-hidden shadow-sm sm:rounded-lg">
            <p>Historique de mes commandes :</p>
            @foreach($bills as $bill)
            <article class="bill">
                <h2>Facture numéro {{ $bill->id }}</h2>
                <h3>Articles commandés :</h3>
                @php($i = 0)
                @foreach($orders as $order)
                @if(isset($order[$i]->index_id) && $order[$i]->index_id === $bill->order_index)
                <div class="article">
                    <h3>- Référence : {{ $order[$i]->product_reference }}</h3>
                    <h3>- Quantité : {{ $order[$i]->quantity }}</h3>
                </div>
                @php($i++)
                @endif
                @endforeach
            </article>
            @endforeach
        </section>
    </div>
</main>
@endsection
