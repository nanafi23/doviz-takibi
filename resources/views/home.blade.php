<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döviz Çevirici</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #6e48aa 0%, #9d50bb 100%);
            color: white;
        }
        .hero-section {
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="hero-section d-flex flex-column justify-content-center align-items-center">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Hoş Geldiniz</h1>
            <p class="lead mb-5">Profesyonel döviz çevirme platformuna erişmek için giriş yapın</p>
            
            <div class="d-flex gap-3 justify-content-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Panele Git</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Kayıt Ol</a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>