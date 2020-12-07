@extends('layouts.app')

@section('content')

<form class="login" method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <h1>Créer un compte</h1>
    </div>
    <div>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>
    </div>
    <div>
        <input type="text" class="champs" placeholder="{{ __('Pseudo') }}" name="username" id="username" required autocomplete="username" autofocus>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <input type="text" class="champs" placeholder="{{ __('Email') }}" name="email" id="email" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <input type="password" class="champs" placeholder="{{ __('Mot de Passe') }}" name="password" id="password" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <input type="password" class="champs" placeholder="{{ __('Confirmer Mot de Passe') }}" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
    </div>
    <p>By creating an account you agree to our <a href="# ">Terms & Privacy</a>.</p>
    <button type="submit" class="buttony">{{ __('S\'incrire') }}</button>
    </div>

    <div>
        <p>Already have an account? <a href="{{ route('login') }}">{{ __('Se connecter') }}</a>.</p>
    </div>
</form>
@endsection