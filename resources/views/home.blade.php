@extends('layouts.app')
@section('title', 'Ma page Personelle')
@section('content')
<div style="color:white">
    <div>{{ __('Ma page Personelle') }}</div>
    {{ __('Vous êtes connecté!') }}
        @if (Auth::user()->usertype=="admin")
        <div><br>
            <a class="button" href="{{ route('admin') }}">Ajouter un produit</a>
        </div><br>
        @endif
    <div>
        <br>
        <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Deconnexion') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
