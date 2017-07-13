@extends('layouts.layout')
@section('title', 'Nome do Evento')
@section('content')

    <header>
        <h2>Nome do Evento</h2>
        <h5>Slogan do evento</h5>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('/eventos/components/galeriaEventos')
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="text-center">O que é o evento?</h2>
                    <p class="paragrafo">
                        Mussum Ipsum, cacilds vidis litro abertis. Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis. Não sou faixa preta cumpadi, sou preto inteiris, inteiris. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Diuretics paradis num copo é motivis de denguis.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="{{ url('/geralzaum2') }}"><h2>Confira as atividades</h2></a>
                </div>
            </div>
        </div>

    </section>
@endsection