@extends('layouts.base')

@section('head')
@parent
@section('title', 'Confirmation')
<link href="{{ asset('css/confirmation.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<p>{{ var_dump($bill) }}</p>
@endsection