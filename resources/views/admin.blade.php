@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<form class="login" enctype="multipart/form-data" method="POST" action="{{ route('admin') }}">
    @csrf
    <div id="nbConnect"></div>
    <div id="nbCommandes"></div>
    <div id="maxCommandes"></div>
    <div>
        <label for="name"><b>Nom Produit</b></label>
        <input type="text" class="champs" placeholder="Produit" name="name" id="name" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="category"><b>Catégorie</b></label>
        <input type="text" class="champs" placeholder="Catégorie" name="category" id="category" required>
        @error('category')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="stock"><b>Quantité</b></label>
        <input type="number" class="champs" placeholder="Quantité" name="stock" id="stock" required>
        @error('stock')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="price"><b>Prix</b></label>
        <input type="number" class="champs" step="0.01" placeholder="Prix" name="price" id="price" required>
        @error('price')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="description"><b>Description</b></label>
        <textarea cols="40" rows="5" class="champs" placeholder="Description" name="description" id="description" required></textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="picture"><b>Image</b></label>
        <input type="file" class="champs" name="picture" id="picture" required>
        @error('picture')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <button type="submit " class="buttony">Ajouter</button>
        @if(session('message'))
            {{session('message')}}
        @endif
    </div>

</form>
@endsection
