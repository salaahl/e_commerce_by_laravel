@extends('layouts.base')

@section('head')
@parent
@section('title', 'Page introuvable')
<link href="{{ asset('css/404.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<section class="page_404">
  <div class="container">
    <div class="row"> 
    <div class="col-sm-12 ">
    <div class="col-sm-10 col-sm-offset-1  text-center">
    <div class="four_zero_four_bg">
      <h1 class="text-center ">404</h1>
    
    
    </div>
    
    <div class="contant_box_404">
    <h3 class="h2">Vous semblez perdu</h3>
    
    <p>La page que vous recherchez n'est pas disponible !</p>
    
    <a href="/" class="link_404">Retourner à la page d'accueil</a>
  </div>
    </div>
    </div>
    </div>
  </div>
</section>
@endsection
