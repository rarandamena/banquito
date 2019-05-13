<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banquito</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>
<body>

<main style="display: flex; align-items: center; justify-content: center; height: 100vh; width: 100vw;">

    <div style="margin: auto; text-align: center">
        <h1>El banquito de Mejico</h1>
        <h2>$ En pejos $</h2>
        <img src="http://s2.subirimagenes.com/otros/previo/thump_437958772201232244894447147.jpg" alt="">
        <br>
        <br>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-info">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Entrar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</main>

</body>
</html>
