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
        <div id="slide1" class="slide" style="background-image: url('images/illustration_1.jpg');">
            <a href="#"><i class="arrow previous"></i></a>
            <div class="description">
                <h3>Slide 1</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </div>
            <a href="#slide2"><i class="arrow next"></i></a>
        </div>
        <div id="slide2" class="slide" style="background-image: url('images/illustration_2.jpg');">
            <a href="#slide1"><i class="arrow previous"></i></a>
            <div class="description">
                <h3>Slide 2</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </div>
            <a href="#slide3"><i class="arrow next"></i></a>
        </div>
        <div id="slide3" class="slide" style="background-image: url('images/illustration_1.jpg');">
            <a href="#slide2"><i class="arrow previous"></i></a>
            <div class="description">
                <h3>Slide 3</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </div>
            <a href="#slide4"><i class="arrow next"></i></a>
        </div>
        <div id="slide4" class="slide" style="background-image: url('images/illustration_2.jpg');">
            <a href="#slide3"><i class="arrow previous"></i></a>
            <div class="description">
                <h3>Slide 4</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore
                    magna aliqua.
                </p>
            </div>
            <a href="#"><i class="arrow next"></i></a>
        </div>
    </div>
</div>
@endsection

@section('main-content')
<main>
    <h1>Top ventes</h1>
    <section class="one">
        <div class="section-text">
            <h3>Articles à la une</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
        </div>
        @if($bestsellers)
        @foreach($bestsellers as $article)
        <div class="article">
            <a href="/articles/{{ $article->reference }}">
                <div class="article-img-container">
                    <img src="{{ asset('images/' . $article->picture) }}" />
                </div>
                <div class="description">
                    <h3>{{ $article->name }}</h3>
                    <h3>{{ $article->price }}€</h3>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </section>
    <section class="two">
        <h2>à la une</h2>
    </section>
    <section class="three">
        @if($article_featured)
        <div class="article">
            <a href="/articles/{{ $article_featured['reference'] }}">
                <div class="article-img-container">
                    <img src="{{ asset('images/' . $article_featured['picture']) }}" />
                </div>
            </a>
        </div>
        <div class="section-text">
            <h3>{{ $article_featured['name'] }}</h3>
            <p>{{ $article_featured['description'] }}</p>
            <p>{{ $article_featured['price'] }}€</p>
        </div>
        @endif
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
