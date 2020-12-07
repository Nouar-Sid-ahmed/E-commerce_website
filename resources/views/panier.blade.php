@extends('layouts.app')
@section('title', 'Panier')
@section('content')
        <div class="login">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Prix Total</th>
                    </tr>
                </thead>
                <tbody id="panier">
                </tbody>
            </table>
            <h3 id="total"></h3>
            <p><button class="buttony" onclick="commande()" <?php
                    if(isset($_COOKIE['commande'])){
                        file_put_contents('../public/js/Commandes.txt',$_COOKIE['commande']);
                        setcookie('commande');
                        unset($_COOKIE['commande']);
                    }?>>Procedez au Paiement</button></p>
        </div>
@endsection
