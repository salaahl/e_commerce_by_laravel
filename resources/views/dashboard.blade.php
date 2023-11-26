@extends('layouts.base')

@section('head')
@parent
@section('title', 'Panier')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Tableau de bord</h1>
    <h3>
        <a href="/orders">Mes commandes</a>
    </h3>
    <h3>
        <a href="/profile">Modifier mes informations</a>
    </h3>
</main>
@endsection
