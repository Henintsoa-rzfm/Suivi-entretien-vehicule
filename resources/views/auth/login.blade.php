<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> -->
<body>
<div class="wrapper">
    <div class="logo"> <img src="images/LogoDST.png" alt=""> </div> <!--https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png-->
    <div class="text-center mt-4 name"> D S T </div>
    
        <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="p-3 mt-3">
        @csrf
        {{-- <x-label for="email" :value="__('Email')" /> --}}
        <div class="form-field d-flex align-items-center"> 
            <span class="far fa-user"></span> 
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  id="userName" placeholder="Utilisateur"> 
        </div>
        <div class="form-field d-flex align-items-center"> 
            <span class="fas fa-key"></span> <input id="password" class="block mt-1 w-full"
            type="password" name="password" type="password"  placeholder="Mot de passe"> 
        </div> 
        <button type="submit" class="btn mt-3 bg-dark">{{ __('Se connecter') }}</button>
    </form>
    {{-- <div class="text-center fs-6"><a href="{{route('register')}}">Créer un nouveau compte</a> </div> --}}
</div>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- <body class="bodya">
<x-guest-layout>
    <x-auth-card class="ityaho">
        <x-slot name="logo">
            <a href="/"> --}}
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                {{-- <img src="{{asset("images/.png")}}" alt=""> --}}
            {{-- </a> --}}
        {{-- </x-slot> --}}

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <style>p{text-align: center}</style>
            <p>IDENTIFIEZ-VOUS</p>
            <br> --}}
            <!-- Email Address -->
            {{-- <style>
                #email{
                    width: 100%;
                    display: block;
                    border: ;
                    outline: none;
                    background: none;
                    font-size: 1.2rem;
                    color: #667;
                    padding: 10px 15px 10px 10px
                };
                .form-field {
                    padding-left: 10px;
                    margin-bottom: 20px;
                    border-radius: 20px;
                    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
                }
                </style>
            <div class="form-field">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
<style>
    #password{
        width: 100%;
        display: block;
        border: ;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #667;
        padding: 10px 15px 10px 10px
    };</style>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mot de passe')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4"> --}}
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif --}}
{{-- <style>#mybou{ background: #03A9F4}</style>
                <x-button class="ml-3" id="mybou">
                    {{ __('Se connecter') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
</body> --}}