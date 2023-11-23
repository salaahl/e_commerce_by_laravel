// En cours

@extends('layouts.base')

@section('head')
@parent
@section('title', 'Create')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<form method="DELETE" class="form" action="{{url('/CRUD/delete')}}">
    @csrf
    <h1>Supprimer un catalogue :</h1>
</form>

<form method="DELETE" class="form" action="{{url('/CRUD/delete')}}">
    @csrf
    <h1>Supprimer un produit :</h1>
</form>
@endsection
