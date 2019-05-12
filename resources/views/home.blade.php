<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banquito</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <style>
        .error, .success {
            margin-top: 25px;
            font-size: 21px;
            text-align: center;

            -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
            -moz-animation: fadein 2s; /* Firefox < 16 */
            -ms-animation: fadein 2s; /* Internet Explorer */
            -o-animation: fadein 2s; /* Opera < 12.1 */
            animation: fadein 2s;
        }

        @keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Firefox < 16 */
        @-moz-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Safari, Chrome and Opera > 12.1 */
        @-webkit-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Internet Explorer */
        @-ms-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

    </style>
</head>
<body>

<main style="display: flex; align-items: center; justify-content: center; height: 100vh; width: 100vw;">

    <div style="margin: auto; text-align: center; width: 600px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="font-size: 25px">
                            <div style="text-align: center" > Bienvenido, {{ $user->name }}</div>
                            <a href="{{ route('logout') }}" class="btn btn-flat btn-outline-danger align-bottom"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                                Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-4">
                                    <p class="float-left">
                                        Tu balance es:
                                    </p>
                                </div>

                                <div class="col-8">
                                    <p class="float-right">
                                        ${{ number_format($user->balance , 2, '.', ',') }} Pejitos
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-4">
                                    <p class="float-left">
                                        Abonar a cuenta
                                    </p>
                                </div>

                                <div class="col-8">
                                    <div class="float-right">
                                        <form action="{{ URL::route('deposit') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="number" min="1" max="1000000" step="1" placeholder="Monto"
                                                   class="form-control mb-1" name="monto">
                                            <button type="submit" class="btn btn-success form-control">Abonar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-5">
                                    <p class="float-left">
                                        Retirar (max. $1,000 por retiro)
                                    </p>
                                </div>

                                <div class="col-7">
                                    <div class="float-right">
                                        <form action="{{ URL::route('withdraw') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="number" max="1000000" step="1" placeholder="Monto"
                                                   class="form-control mb-1" name="monto">
                                            <button type="submit" class="btn btn-danger form-control">Retirar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-5">
                                    <p class="float-left">
                                        Transeferir (max. $1,000 por retiro)
                                    </p>
                                </div>

                                <div class="col-7">
                                    <div class="float-right">
                                        <form action="{{ URL::route('transfer') }}" method="POST">
                                            {{ csrf_field() }}
                                            <select name="user" class="form-control">
                                                @foreach($users as $u)
                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" max="1000000" step="1" placeholder="Monto"
                                                   class="form-control mb-1" name="monto">
                                            <button type="submit" class="btn btn-primary form-control">Transferir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div style="width: 95%; text-align: center; margin: 15px auto;">
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger c-font-24 error">
                                            {{$error}}
                                        </div>
                                    @endforeach
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success c-font-24 success">
                                        {{session('success')}}
                                    </div>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
