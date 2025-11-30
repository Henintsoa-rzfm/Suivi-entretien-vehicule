
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Connexion</title>
<link rel="stylesheet" href="{{asset('css/form.css')}}">
</head>
<body>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}" id="vehicleForm" class="form">
    <h1 class="brand">FiaraTrack</h1>
    @csrf
    <div class="form-group">
        <input type="text" name="email" :value="old('email')"  id="userName" placeholder="Utilisateur : email@email.com" required>
    </div>

    <div class="form-group">
        <input id="password" type="password" name="password" placeholder="Mot de passe">
    </div>
    <button type="submit" class="btn mt-3">{{ __('Se connecter') }}</button>
    <a style="text-align: center;" href="{{route('register')}}">Je n'ai pas de compte</a>
</form>


</body>
</html>
