<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGE @yield('title')</title>
    <!-- Styles -->
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/footer.css') }}
    {{ Html::script('js/jquery.min.js') }}
    {{Html::script('js/jquery.mask.js')}}
<!-- Scripts -->
    {{Html::script('js/bootstrap.min.js')}}
    {{ Html::style('css/beautify.css') }}
    {{ Html::style('css/main.css') }}
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a class="navbar-brand" href="{!! route("dashboard") !!}">
                        <i class="fa fa-calendar"></i>
                        SGE
                    </a>
                    @if (!Auth::guest())
                        <p class="navbar-brand"> Bem-Vindo {{ Auth::user()->nome }}</p>
                    @endif
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('eventosPublico::index')  }}"><i class="fa fa-home" aria-hidden="true"></i>
                            Inicial</a></li>
                    @if(!Auth::guest())
                        <li><a href="http://vandalvnl.github.io"><i class="fa fa-user" aria-hidden="true"></i>
                                Perfil</a></li>
                        <li><a href="{{ route('auth::logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                        </li>
                    @else
                        <li><a href="{{ route('auth::login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="container">
    @yield('content')
</div>
@include('layouts.footerPublico')
</body>
</html>
