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
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/beautify.min.css') }}
    {{ Html::style('css/footer.css') }}
    {{ Html::style('css/slick.css') }}
    {{ Html::style('css/slick-theme.css') }}
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/blog.css') }}
    <link href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/animate.min.css" rel="stylesheet"/>
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

                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{!! route("eventosPublico::visualizar", ['nomeSlug' => $evento->nomeSlug]) !!}"
                           class="">
                            <i class="fa fa-home" aria-hidden="true"></i> Inicial</a>
                    </li>
                    @if($evento->eventoCaracteristica->eExistemImagens)
                        <li><a href="{{ route('eventosPublico::galeria', ['nomeSlug' => $evento->nomeSlug]) }}"><i
                                        class="fa fa-picture-o" aria-hidden="true"></i> Galeria</a></li>
                    @endif
                    @if($evento->eventoCaracteristica->eExistemNoticias)
                        <li><a href="{{ route('eventosPublico::avisos', ['nomeSlug' => $evento->nomeSlug]) }}"><i
                                        class="fa fa-newspaper-o" aria-hidden="true"></i> Avisos</a></li>
                    @endif
                    <li><a href="{{ route('eventosPublico::atividadesEvento', ['nomeSlug' => $evento->nomeSlug]) }}"><i
                                    class="fa fa-th-list" aria-hidden="true"></i> Atividades</a></li>
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
    @if($evento->eventoCaracteristica->eImagemDeFundo)
        <div id="carousel-example-generic" class="carousel slide">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active text-center">
                    <img width="100%" src="{{asset($evento->eventoCaracteristica->background) }}">
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('message'))
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('message')}}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('error')}}
        </div>
    @endif
    @yield('content')
</div>
@include('layouts.footerPublico')
<script>
    (function ($) {
//Function to animate slider captions
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = 'webkitAnimationEnd animationend';
            elems.each(function () {
                var $this = $(this),
                    $animationType = $this.data('animation');
                $this.addClass($animationType).one(animEndEv, function () {
                    $this.removeClass($animationType);
                });
            });
        }

//Variables on page load
        var $myCarousel = $('#carousel-example-generic'),
            $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
//Initialize carousel
        $myCarousel.carousel();
//Animate captions in first slide on page load
        doAnimations($firstAnimatingElems);
//Pause carousel
        $myCarousel.carousel('pause');
//Other slides to be animated on carousel slide event
        $myCarousel.on('slide.bs.carousel', function (e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });
    })(jQuery);
</script>
</body>
</html>
