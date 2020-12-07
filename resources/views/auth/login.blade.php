@extends('layouts.app')
@section('title', 'Page de connexion')
@section('content')
<div class="login">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <input class="champs" type="text" placeholder="{{ __('EMAIL') }}" name="email" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div>
            <input class="champs" type="password" placeholder="{{ __('MOT DE PASSE') }}" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div>
            <button class="buttony" type="submit">{{ __('Connexion') }}</button>
        </div>
        <div>
            <label><input type="checkbox" checked="checked" name="remember">{{ __('Se souvenir de moi') }}</label><br>
        </div>
        <a href="{{ route('password.request') }}"><img height="40px " src="{{ asset('css/mdp.png') }}"></a>
        <a href="{{ route('register') }}"><img height="40px" src="{{ asset('css/compte.png') }}"></a>
    </form>
</div>
@endsection