@extends('layouts.base')

@section('head')
@parent
@section('title', 'Confirmation')
<link href="{{ asset('css/confirmation.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<main>
    <h1>Commande confirmée !</h1>
    <div class="bill">
    <h4>Date de la commande : 01/01/2023</h4>
        <div id="customer">
            <h4>name</h4>
            <h4>surname</h4>
            <h4>address</h4>
            <h4>phone</h4>
            <h4>email</h4>
        </div>
        <h4 id="command-label">Commande numéro 1</h4>
        <table>
            <thead>
                <tr>
                    <td>Article</td>
                    <td>Quantity</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bleu de Chanel</td>
                    <td>1</td>
                    <td>9.99</td>
                </tr>
            <tfoot>
            <tr>
                    <td>Sous-total :</td>
                </tr>
            <tr>
                    <td>TVA :</td>
                </tr>
                <tr>
                    <td>Total :</td>
                </tr>
            </tfoot>
            </tbody>
        </table>
        <h4>Méthode de payement : Paypal</h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
    </div>
</main>
@endsection