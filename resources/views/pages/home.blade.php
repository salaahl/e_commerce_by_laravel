@extends('layouts.base')

@section('head')
@parent
@section('title', 'Accueil')
<link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('header')
@parent
<div class="carousel">
    <div class="inner">
        <div class="slide" style="background-image: url('/images/illustration_1.jpg');">
            <div class="description">
                <h3>Slide 1</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                </p>
            </div>
        </div>
        <div class="slide" style="background-image: url('/images/illustration_2.jpg');">
            <div class="description">
                <h3>Slide 2</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                </p>
            </div>
        </div>
        <div class="slide" style="background-image: url('/images/illustration_1.jpg');">
            <div class="description">
                <h3>Slide 3</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                </p>
            </div>
        </div>
        <div class="slide" style="background-image: url('/images/illustration_2.jpg');">
            <div class="description">
                <h3>Slide 4</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main-content')
<main>
    <h1>à la une</h1>
    <section class="one">
        <div class="section-text">
            <h3>Section 1</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
        </div>
        <div class="article">
            <a href="article.html">
                <div class="img-container">
                    <img src="{{ asset('images/dress.png') }}" />
                </div>
            </a>
        </div>
        <div class="article">
            <a href="article.html">
                <div class="img-container">
                    <img src="{{ asset('images/dress.png') }}" />
                </div>
            </a>
        </div>
    </section>
    <section class="two">
        <h2>Top ventes</h2>
    </section>
    <section class="three">
        <div class="article">
            <a href="article.html">
                <div class="img-container">
                    <img src="{{ asset('images/dress.png') }}" />
                </div>
            </a>
        </div>
        <div class="section-text">
            <h3>Section 3</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
        </div>
    </section>
    <section class="four">
        <div class="article">
            <a href="article.html">
                <div class="img-container">
                    <img src="{{ asset('images/dress.png') }}" />
                </div>
            </a>
        </div>
        <div class="article">
            <a href="article.html">
                <div class="img-container">
                    <img src="{{ asset('images/dress.png') }}" />
                </div>
            </a>
        </div>
        <div class="section-text">
            <h3>Section 4</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
        </div>
    </section>
</main>
@endsection