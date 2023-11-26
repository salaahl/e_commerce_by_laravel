@extends('layouts.base')

@section('head')
@parent
@section('title', 'Articles')
<link href="{{ asset('css/products.css') }}" rel="stylesheet" type="text/css" />
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
    <section class="products">
        @foreach($products as $product)
        <article class="product">
            <a href="/products/{{ $product['reference'] }}">
                <div class="product-img-container">
                    <img src="{{ asset('images/' . $product['picture']) }}" alt="{{ $product['name'] }} picture" />
                </div>
                <div class="description">
                    <h3>{{ $product['name'] }}</h3>
                    <h3>{{ $product['price'] }}€</h3>
                </div>
            </a>
        </article>
        @endforeach
    </section>
</main>
<aside>
    {{ $products->links() }}
</aside>
@endsection