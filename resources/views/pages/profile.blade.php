@extends('layouts.base')

@section('head')
@parent
@section('title', 'Profile')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<header class="bg-white shadow">
  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Mon profil
      </h2>
  </div>
</header>
<main>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
              <div class="p-6 text-gray-900">
                  <a href="#">Modifier mes informations</a>
              </div>
          </div>
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  Historique de mes commandes :
                  @foreach($bills as $bill)
                    <p> 
                        Facture numéro : {{ $bill->id }}
                        Articles commandés :
                        @foreach($orders as $order)
                            @if($order['index_id'] == $bill->order_index)
                                - Référence : {{ $order['product_reference'] }}
                                Quantité : {{ $order['quantity'] }}
                            @endif
                        @endforeach
                    </p>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</main>
@endsection
