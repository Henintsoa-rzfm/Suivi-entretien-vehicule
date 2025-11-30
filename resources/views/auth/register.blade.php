<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<body>
<div class="wrapper">

        <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('register') }}" class="p-3 mt-3">
        @csrf
        @if($errors->any())
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger" style="color: black">{{ $error }}</div>
        @endforeach
      @endif
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  placeholder="Nom Utilisateur">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input id="email" class="block mt-1 w-full" type="emeail" name="email" :value="old('email')"  placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input id="password" class="block mt-1 w-full"
            type="password" name="password" type="password"  placeholder="Mot de passe">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input id="password" class="block mt-1 w-full"
            type="password" name="password_confirmation" type="password"  placeholder="Confirmation du Mot de passe">
        </div>
        <button type="submit" class="btn mt-3 bg-dark">{{ __('S\'inscrire') }}</button>
    </form>
    <div class="text-center fs-6"><a href="{{route('login')}}">J'ai déjà un compte</a> </div>
</div>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>

{{-- Ity ra ohatra manondrana --}}
<script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
{{-- ------------------------ --}}
</body>
</html>









{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf --}}

            <!-- Name -->
            {{-- <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div> --}}

            <!-- Email Address -->
            {{-- <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div> --}}

            <!-- Password -->
            {{-- <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div> --}}

            <!-- Confirm Password -->
            {{-- <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
