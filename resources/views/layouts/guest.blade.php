@extends('layouts.base')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Connexion')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection
                
@section('main-content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <x-application-logo />
        </a>
    </div>

    <div class="w-full sm:max-w-md m-auto px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
@endsection
