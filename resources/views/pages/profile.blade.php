@extends('layouts.base')

@section('head')
@parent
@section('title', 'Profile')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Mon profil</h1>
    <div class="mx-auto">
        <section class="overflow-hidden shadow-sm sm:rounded-lg">
            <h4>Historique de mes commandes :</h4>
            @foreach($bills as $bill)
            <article class="bill">
                <h2>Facture numéro {{ $bill->id }}</h2>
                <h3>Articles commandés :</h3>
                @php($i = 0)
                @foreach($orders as $order)
                @if(isset($order[$i]->index_id) && $order[$i]->index_id === $bill->order_index)
                <div class="product">
                    <h4>- Référence : {{ $order[$i]->product_reference }}</h4>
                    <h4>- Quantité : {{ $order[$i]->quantity }}</h4>
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
