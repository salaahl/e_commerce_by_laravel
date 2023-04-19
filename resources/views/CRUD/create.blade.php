@extends('layouts.base')

@section('head')
@parent
@section('title', 'Create')
<link href="{{ asset('css/create_form.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<form method="GET" id="form-dish" class="form" action="{{url('/CRUD/store')}}">
    @csrf
    <h1>Ajouter un nouveau catalogue :</h1>
    <p class="field required">
        <input type="text" id="catalog" name="catalog" required="required" class="text-input" placeholder="Nom du catalogue">
    </p>
    <p class="field">
        <input class="button" type="submit" value="Send">
    </p>
</form>

<form method="GET" id="form-dish" class="form" action="{{url('/CRUD/store')}}">
    @csrf
    <h1>Ajouter un nouveau produit :</h1>
    <p class="field required">
        <input type="text" id="product_reference" name="product_reference" required="required" class="text-input" placeholder="Reference du produit">
    </p>
    <p class="field required">
        <input type="text" id="product_name" name="product_name" required="required" class="text-input" placeholder="Nom du produit">
    </p>
    <p class="field required">
        <textarea name="product_description" required="required" class="textarea" placeholder="100 caractères maximum."></textarea>
    </p>
    <p class="field required">
        <input type="text" id="product_price" name="product_price" required="required" inputmode="decimal" class="text-input" placeholder="9.99">
    </p>
    <p class="field required">
        <input type="number" id="product_stock" name="product_stock" class="text-input" placeholder="Stock">
    </p>
    <div class="field required">
        <label class="label">Type</label>
        <ul class="checkboxes">
            <li class="checkbox">
                <select id="product_catalog" class="text-input" name="product_catalog">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Enfant">Enfant</option>
                    <option value="Femme">Maison</option>
                </select>
            </li>
        </ul>
    </div>
    <p class="field required">
        <input type="file" id="product_picture" name="product_picture" accept="image/png, image/jpeg, image/svg">
    </p>
    <p class="field">
        <input class="button" type="submit" value="Send">
    </p>
</form>
@endsection
