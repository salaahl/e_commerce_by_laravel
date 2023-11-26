@extends('layouts.base')

@section('head')
@parent
@section('title', 'Panier')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<h1>Tableau de bord</h1>
<h2>
    <a href="/orders">Mes commandes</a>
</h2>
<h2>
    <a href="/edit-profile">Modifier mes informations</a>
</h2>
@endsection
