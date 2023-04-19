@extends('layouts.base')

@section('head')
@parent
@section('title', 'Create')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<form method="GET" class="form" action="{{url('/CRUD/store')}}">
    @csrf
    <h1>Ajouter un nouveau catalogue :</h1>
    <p class="field required">
        <input type="text" id="catalog-name" name="name" required="required" class="text-input" placeholder="Nom du catalogue">
    </p>
    <p class="field">
        <input class="button" type="submit" value="Send">
    </p>
    <input name="form" type="hidden" value="catalog">
</form>

<form method="GET" class="form" action="{{url('/CRUD/store')}}">
    @csrf
    <h1>Ajouter un nouveau produit :</h1>
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
        <input class="button" type="submit" value="Send">
    </p>
    <input name="form" type="hidden" value="product">
</form>
@endsection
