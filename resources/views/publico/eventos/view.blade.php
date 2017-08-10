@extends('layouts.eventoPublico')
@section('title', "- Eventos")
@section('content')
    <div id="wrapper">
        <div class="row">
            <div class="conteiner">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                    <header>
                        <h1>{{ $evento->nome }}</h1>
                        <p class="paragrafo">
                            {{ $evento->descricao }}
                        </p>
                    </header>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{--@include('eventos.components.galeriaEventos')--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
