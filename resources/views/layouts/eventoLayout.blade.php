<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGE @yield('title')</title>
    <!-- Styles -->
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/beautify.css') }}
    {{ Html::style('css/footer.css') }}
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/styles.css') }}
    {{ Html::script('js/jquery.min.js') }}
    {{Html::script('js/jquery.mask.js')}}

    <!-- Scripts -->
    {{Html::script('js/bootstrap.min.js')}}
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Raleway:400,500,600" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <i class="fa fa-calendar"></i>
                        SGE
                    </a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="" class=""><i class="fa fa-home" aria-hidden="true"></i> Inicial</a></li>
                    <li><a href="" class=""><i class="fa fa-coffee" aria-hidden="true"></i> Eventos</a></li>
                    <li><a href=""><i class="fa fa-certificate" aria-hidden="true"></i> Certificados</a></li>
                    <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
                    <li><a href=""><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                    <li><a href=""><i class="fa fa-calendar" aria-hidden="true"></i> Atividades</a></li>
                    <li><a href=""><i class="fa fa-picture-o" aria-hidden="true"></i> Galeria</a></li>
                    <li><a href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i> Notícias</a></li>
                    <li><a href=""><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>

<div class="conteiner-fluid">

    @yield('content')

    <div class="espacos"></div>
    <div class="espacos"></div>
</div>
</body>
</html>
