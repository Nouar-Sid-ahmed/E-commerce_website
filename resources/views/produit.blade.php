@extends('layouts.app')
@section('title', '{{ $produit->name }}')
@section('content')
    <h1 class="namimage"><strong>{{ $produit->name }}</strong></h1>
        <div class="article">
            <a><img class="imge" src="{{ asset($produit->picture) }}" all="failled load"></a>
                    <div class="description">
                        <p>{{ $produit->description }}</p><br>
                        <div class="categori">Catégorie : {{ $produit->category }}</div><br>
                        <div class="prix">{{ $produit->price }} € TTC</div>
                    </div>
        </div>
        <div class="validation">
            <button class="button" onclick="ajoutPanier({{ $produit->id }},'{{ $produit->name }}',{{ $produit->price }},{{ $produit->stock }});location.href='{{ route('panier') }}'" >Ajouter aux panier</button>
        </div>
            @if( Auth::user())
                @if (Auth::user()->usertype=="admin")
                    <div>
                    <form class="login" enctype="multipart/form-data" method="POST" action="{{ route('update',$produit->id) }}">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$produit->id}}">
                        <input type="number" class="champs" placeholder="Quantité" name="stock" id="stock" required>
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <button type="submit" class="buttony">Modifier Stock</button>
                        @if(session('message'))
                            {{session('message')}}
                        @endif
                        </div>
                    <br>
                    </form>
                @endif
            @endif
            <div class="stock">
                <p>Produit en Stock: {{ $produit->stock }}</p>
            </div>
@endsection
