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
        <h4>Trier par (ordre ascendant) :</h4>
        <ul class="filters">
            <li>
                <form>
                    @csrf
                    <button type="submit" @if(request()->get('order') == 'new') class="active" @endif>Nouveautés</button>
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
