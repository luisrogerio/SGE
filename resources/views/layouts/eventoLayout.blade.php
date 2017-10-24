<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGE @yield('title')</title>
    <!-- Styles -->
{{ Html::style('css/font-awesome.min.css') }}
{{ Html::style('css/beautify.min.css') }}
{{ Html::style('css/footer.css') }}
{{ Html::style('css/main.css') }}
<!-- Scripts -->
    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/jquery.mask.js')}}
    {{ Html::script('js/bootstrap.min.js')}}
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
                    <a class="navbar-brand" href="{!! route("eventosPublico::index") !!}">
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
                    <li>
                        <a href="{!! route("eventosPublico::visualizar", ['nomeSlug' => $evento->nomeSlug]) !!}" class="">
                            <i class="fa fa-home" aria-hidden="true"></i> Inicial</a>
                    </li>
                    @if($evento->eventoCaracteristica->eExistemImagens)
                        <li><a href=""><i class="fa fa-picture-o" aria-hidden="true"></i> Galeria</a></li>
                    @endif
                    @if($evento->eventoCaracteristica->eExistemNoticias)
                        <li><a href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i> Avisos</a></li>
                    @endif
                    <li><a href="{{ route('eventosPublico::atividadesEvento', ['nomeSlug' => $evento->nomeSlug]) }}"><i
                                    class="fa fa-th-list" aria-hidden="true"></i> Programação</a></li>
                    @if(Auth::guest())
                        <li><a href="{{route('auth::login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                Login</a></li>
                    @else
                        <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
                        <li><a href="{{route('auth::logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                Sair</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
{{--@if($evento->eventoCaracteristica->eImagemDeFundo)--}}
{{--<div class="jumbotron">--}}
{{--<div class="container">--}}
{{--<img src="{{ asset($evento->eventoCaracteristica->background) }}" />--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}
<div class="container">
    @yield('content')
</div>
@include('layouts.footerPublico')
</body>
</html>
