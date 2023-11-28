@extends('layouts.base')

@section('head')
@parent
@section('title', 'Mon compte')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection

<!-- CSS spécifique au dashboard -->
<style>
    h3 {
        text-align: center;
    }
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        margin: 1rem 0!important;
        padding: 0 1rem;
    }
</style>

@section('main-content')
<main>
    <h1>Mon compte</h1>
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