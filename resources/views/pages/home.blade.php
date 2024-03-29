@extends('layouts.base')

@section('head')
@parent
@section('title', 'Accueil')
<link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('header')
@parent
<section class="carousel">
    <div class="inner" role="list">
        <div id="slide1" class="slide" style="background-image: url('images/illustration_1.jpg');">
            <a href="#"><i class="arrow previous"></i></a>
            <article class="description">
                <h3>Slide 1</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </article>
            <a href="#slide2"><i class="arrow next"></i></a>
        </div>
        <div id="slide2" class="slide" style="background-image: url('images/illustration_2.jpg');">
            <a href="#slide1"><i class="arrow previous"></i></a>
            <article class="description">
                <h3>Slide 2</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </article>
            <a href="#slide3"><i class="arrow next"></i></a>
        </div>
        <div id="slide3" class="slide" style="background-image: url('images/illustration_1.jpg');">
            <a href="#slide2"><i class="arrow previous"></i></a>
            <article class="description">
                <h3>Slide 3</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </article>
            <a href="#slide4"><i class="arrow next"></i></a>
        </div>
        <div id="slide4" class="slide" style="background-image: url('images/illustration_2.jpg');">
            <a href="#slide3"><i class="arrow previous"></i></a>
            <article class="description">
                <h3>Slide 4</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </article>
            <a href="#"><i class="arrow next"></i></a>
        </div>
    </div>
</section>
@endsection

@section('main-content')
<main>
    <h1>Accueil</h1>
    <section class="bestsellers">
        <div class="section-text">
            <h2>Top ventes</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore
                magna aliqua.
            </p>
        </div>
        @if($bestsellers)
        @foreach($bestsellers as $product)
        <article class="product">
            <a href="/products/{{ $product->reference }}">
                <div class="img-container">
                    <img src="{{ asset('images/' . $product->picture) }}" />
                </div>
                <div class="description">
                    <h3>{{ $product->name }}</h3>
                    <h3>{{ $product->price }}€</h3>
                </div>
            </a>
        </article>
        @endforeach
        @endif
    </section>
    <section class="featured">
        <div>
            <h2>à la une</h2>
        </div>
        @if($product_featured)
        <div class="section-text">
            <a href="/products/{{ $product_featured->reference }}">
                <h3>{{ $product_featured->name }}</h3>
            </a>
            <p>{{ $product_featured->description }}</p>
            <p>{{ $product_featured->price }}€</p>
        </div>
        <div class="product">
            <a href="/products/{{ $product_featured->reference }}">
                <div class="img-container">
                    <img src="{{ asset('images/' . $product_featured->picture) }}" alt="product image" />
                </div>
            </a>
        </div>
        @endif
    </section>
    <section class="coming-soon">
        <div class="section-text">
            <h2>Nouvelle collection</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
        </div>
        @if($products_new)
        @foreach($products_new as $product)
        <article class="product">
            <a href="/products/{{ $product->reference }}">
                <div class="img-container">
                    <img src="{{ asset('images/' . $product->picture) }}" />
                </div>
                <div class="description">
                    <h3>{{ $product->name }}</h3>
                    <h3>{{ $product->price }}€</h3>
                </div>
            </a>
        </article>
        @endforeach
        @endif
    </section>
</main>
@endsection