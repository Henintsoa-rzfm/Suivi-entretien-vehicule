
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Connexion</title>
<link rel="stylesheet" href="{{asset('css/form.css')}}">
</head>
<body>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('register') }}" id="vehicleForm" class="form">
    <h1 class="brand">FiaraTrack</h1>
    @csrf
        @if($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" style="color: black">{{ $error }}</div>
        @endforeach
    @endif
    <div class="form-group">
        <input type="text" name="name" :value="old('name')" placeholder="Nom de l'utilisateur" required>
    </div>
    <div class="form-group">
        <input type="text" name="email" type="email" name="email"  placeholder="Email" :value="old('email')"required>
    </div>
    <div class="form-group">
        <input  type="password" name="password"
        required autocomplete="new-password" placeholder="Mot de passe">
    </div>
    <div class="form-group">
        <input id="password" type="password" name="password_confirmation" type="password"  placeholder="Confirmation du Mot de passe">
    </div>
    <button type="submit" class="btn mt-3">{{ __('S\'inscrire') }}</button>
        <a style="text-align: center;" href="{{route('login')}}">J'ai déjà un compte</a>
</form>
</body>
</html>
