@extends('layouts.base')

@section('head')
@parent
@section('title', 'Panier')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Tableau de bord</h1>
    <section id="dashboard-links">
        <article id="orders-link">
            <h3>
                <a href="/orders">Mes commandes</a>
            </h3>
        </article>
        <article id="profile-link">
            <h3>
                <a href="/profile">Modifier mes informations</a>
            </h3>
        </article>
    </section>
</main>
@endsection
