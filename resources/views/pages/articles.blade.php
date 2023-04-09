@extends('layouts.base')

@section('head')
@parent
@section('title', 'Articles')
<link href="{{ asset('css/articles.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Articles</h1>
    <div class="filter-bar">
        <h4>Trier par :</h4>
        <ul class="filters">
            <a href="#">Prix</a>
            <a href="#">Notes</a>
            <a href="#">Meilleures ventes</a>
        </ul>
    </div>
    <div class="articles">
        @foreach($articles as $article)
        <div class="article">
            <a href="/articles/{{ $article['reference'] }}">
                <div class="article-img-container">
                    <img src="{{ asset('images/' . $article['picture']) }}" />
                </div>
                <div class="description">
                    <h3>{{ $article['name'] }}</h3>
                    <h3>{{ $article['price'] }}€</h3>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</main>
<aside>
    {{ $articles->links() }}
</aside>
@endsection