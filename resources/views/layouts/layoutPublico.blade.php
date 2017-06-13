<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Informações de Dispositivo para Bootstrap 3-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS para Bootstrap, Select e Ícones-->
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/bootstrap-theme.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    @yield('cssExtras')

    {{ Html::style('css/cssPublico.css') }}
    <title>SGE - @yield('title')</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
{{ Html::script('js/bootstrap.js') }}
@yield('scriptsExtras')
@include('layouts.headerPublico')
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
</body>
</html>