<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGE @yield('title')</title>
    {{ Html::favicon('http://www.jf.ifsudestemg.edu.br/imagens/ifet.ico') }}
<!-- Styles -->
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/footer.css') }}
    {{ Html::style('css/beautify.css') }}
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
<!-- Scripts -->
    {{--<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="--}}
            {{--crossorigin="anonymous"></script>--}}
    {{--{{ Html::script('js/jquery.mask.js')}}--}}
    {{--{{ Html::script('js/moment.js') }}--}}
    {{--{{ Html::script('js/bootstrap.min.js')}}--}}
    {{--{{ Html::script('js/bootstrap-datetimepicker.min.js') }}--}}
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>
    {{ Html::script('js/moment.js') }}
    {{ Html::script('js/bootstrap.js') }}
    {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('js/select2.js') }}
    {{Html::script('js/jquery.mask.js')}}
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
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('eventosPublico::index')  }}"><i class="fa fa-home" aria-hidden="true"></i>
                            Inicial</a></li>
                    @if(Auth::guest())
                        <li><a href="{{route('auth::login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> Conta <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                              <span>
                                <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->nome }}
                              </span>
                                </li>
                                <li></li>
                                <div class="btn-group text-right">
                                    <a class="btn button button-blue" href="{{ route('perfil') }}">
                                        <i class="fa fa-user" aria-hidden="true"></i> Perfil
                                    </a>
                                    {{--<a class="btn button button-green" href="">--}}
                                    {{--<i class="fa fa-certificate" aria-hidden="true"></i> Certificados--}}
                                    {{--</a>--}}
                                    <a class="btn button button-orange" href="{{ route('auth::logout') }}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Sair
                                    </a>
                                </div>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('message')}}
        </div>
    @endif
    @yield('content')
</div>
@include('layouts.footerPublico')
</body>
</html>
