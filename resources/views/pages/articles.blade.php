@extends('layouts.base')

@section('head')
@parent
@section('title', 'Articles')
<link href="{{ asset('css/articles.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('header')
@parent
<div class="header-img"></div>
@endsection

@section('main-content')
<main>
    <h1>Articles</h1>
    <aside class="filter-bar">
        <h4>Trier par (ordre ascendant) :</h4>
        <ul class="filters">
            <li>
                <form>
                    @csrf
                    <button type="submit" @if(request()->get('order') == 'new' || !request()->get('order')) class="active" @endif>Nouveautés</button>
                    <input name="order" type="hidden" value="new">
                </form>
            </li>
            <li>
                <form>
                    @csrf
                    <button type="submit" @if(request()->get('order') == 'price') class="active" @endif>Prix</button>
                    <input name="order" type="hidden" value="price">
                </form>
            </li>
            <li>
                <form>
                    @csrf
                    <button type="submit" @if(request()->get('order') == 'rating') class="active" @endif disabled>Notes</button>
                    <input name="order" type="hidden" value="rating">
                </form>
            </li>
            <li>
                <form>
                    @csrf
                    <button type="submit" @if(request()->get('order') == 'bestseller') class="active" @endif disabled>Meilleures ventes</button>
                    <input name="order" type="hidden" value="bestseller">
                </form>
            </li>
        </ul>
    </aside>
    <section class="articles">
        @foreach($articles as $article)
        <article class="article">
            <a href="/articles/{{ $article['reference'] }}">
                <div class="article-img-container">
                    <img src="{{ asset('images/' . $article['picture']) }}" alt="{{ $article['name'] }} picture"/>
                </div>
                <div class="description">
                    <h3>{{ $article['name'] }}</h3>
                    <h3>{{ $article['price'] }}€</h3>
                </div>
            </a>
        </article>
        @endforeach
    </section>
</main>
<aside>
    {{ $articles->links() }}
</aside>
@endsection
