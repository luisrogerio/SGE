@extends('layouts.eventoLayout')
@section('title', "- Eventos")
@section('content')
    <div id="wrapper">
        <div class="row">
            <div class="conteiner">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                    <header>
                        <h1 class="text-center">Eventos</h1>
                        <h6 class="text-center"></h6>
                        <ul class="nav nav-tabs nav-pills centered">
                            <li role="presentation" class="active"><a href="#">Resumo Geral</a></li>
                            <li role="presentation" class=""><a href="#">Eventos Abertos para Inscrição</a></li>
                            <li role="presentation" class=""><a href="#">Evento Abertos sem Inscrição</a></li>
                            <li role="presentation" class=""><a href="#">Eventos Finalizados</a></li>
                        </ul>
                    </header>

                    <section class="evento-conteiner">
                        <div class="row">
                            <div class="conteiner">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">
                                            <h3>Lista geral dos eventos</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p>Seguem listados todos os eventos</p>
                                        </div>
                                        <div class="row">
                                            @foreach($eventos as $evento)
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                    <div class="thumbnail">
                                                        <img src="{{ asset($evento->eventoCaracteristica->logo) }}"
                                                             alt="Logo do evento" width="30%" class="img-circle">
                                                        <div class="caption">
                                                            <h3>{{ $evento->nome }}</h3>
                                                            <p>Data do Evento: {{ $evento->dataInicio->day }} de {{ $evento->dataInicio->formatLocalized('%B')}} de {{ $evento->dataInicio->year }}</p>
                                                            <p>Fim do Evento: {{ $evento->dataTermino->day }} de {{ $evento->dataTermino->formatLocalized('%B')}} de {{ $evento->dataTermino->year }} </p>
                                                            <p>Inscrições: {{ $evento->dataInicioInscricao->day }} de {{ $evento->dataInicioInscricao->formatLocalized('%B')}} de {{ $evento->dataInicioInscricao->year }}
                                                                até
                                                                {{ $evento->dataFimInscricao->day }} de {{ $evento->dataFimInscricao->formatLocalized('%B')}} de {{ $evento->dataFimInscricao->year}} </p>
                                                            <p>
                                                                <a href="" class="btn btn-default" role="button">Atividades</a>
                                                                <a href="{{ route('eventosPublico::visualizar', ['id' => $evento->id]) }}" class="btn btn-primary" role="button">Evento</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
