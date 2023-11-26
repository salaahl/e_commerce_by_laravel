@extends('layouts.base')

@section('head')
@parent
@section('title', 'Products')
<link href="{{ asset('css/manage.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Produits</h1>
    <section>
        <h3>Ajouter un nouveau produit :</h3>
        <article>
            <form method="POST" class="form" action="{{url('/products/create')}}">
                @csrf
                <p class="field required">
                    <input type="text" id="product-reference" name="reference" required="required" class="text-input" placeholder="Reference du produit">
                </p>
                <p class="field required">
                    <input type="text" id="product-name" name="name" required="required" class="text-input" placeholder="Nom du produit">
                </p>
                <p class="field required">
                    <textarea name="description" required="required" class="textarea" placeholder="255 caractères maximum."></textarea>
                </p>
                <p class="field required">
                    <input type="text" id="product-price" name="price" required="required" inputmode="decimal" class="text-input" placeholder="9.99">
                </p>
                <p class="field required">
                    <input type="number" id="product-stock" name="stock" class="text-input" placeholder="Stock">
                </p>
                <div class="field required">
                    <label class="label">Type</label>
                    <ul class="checkboxes">
                        <li class="checkbox">
                            <select id="product-catalog" class="text-input" name="catalog">
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                                <option value="Enfant">Enfant</option>
                                <option value="Femme">Maison</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <p class="field required">
                    <input type="file" id="product-picture" name="picture" accept="image/png, image/jpeg, image/svg">
                </p>
                <p class="field">
                    <button class="button" type="submit">Créer</button>
                </p>
                <input name="form" type="hidden" value="product">
            </form>
        </article>
    </section>
    <section>
        <h3>Listing des produits :</h3>
        @foreach($products as $product)
        <article>
            <form class="form" method="POST">
                @csrf
                <div class="field required">
                    <label>Catalogue :</label>
                    <ul class="checkboxes">
                        <li class="checkbox">
                            <select id="product-catalog" class="text-input" name="catalog">
                                <option value="{{ $product['catalog'] }}" selected hidden>{{ $product['catalog'] }}</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                                <option value="Enfant">Enfant</option>
                                <option value="Femme">Maison</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <p class="field required">
                    <label>Référence :</label>
                    <input type="text" name="reference" class="text-input" value="{{ $product['reference'] }}">
                </p>
                <p class="field required">
                    <label>Nom :</label>
                    <input type="text" name="name" class="text-input" value="{{ $product['name'] }}">
                </p>
                <p class="field required">
                    <label for="product-stock">Stock :</label>
                    <input type="number" name="stock" class="text-input" value="{{ $product['stock'] }}">
                </p>
                <button class="button" type="submit" formaction="{{url('/products/update')}}">Mettre à jour</button>
                <button class="button" type="submit" formaction="{{url('/products/destroy')}}">Supprimer</button>
            </form>
        </article>
        @endforeach
    </section>
</main>
<aside>
    {{ $products->links() }}
</aside>
@endsection