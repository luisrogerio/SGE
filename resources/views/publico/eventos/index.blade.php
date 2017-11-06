@extends('layouts.eventoPublico')
@section('title', "- Eventos")
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <header class="col-lg-offset-2 col-md-offset-2">
                <h1 class="text-center">Eventos</h1>
                <h6 class="text-center"></h6>
                <ul class="nav nav-tabs nav-pills centered">
                    <li role="presentation" class="@if($query === null) active @endif"><a
                                href="{{ route('eventosPublico::index') }}">Resumo Geral</a></li>
                    <li role="presentation" class="@if($query == 'inscricao') active @endif"><a
                                href="{{ route('eventosPublico::index', ['query' => 'inscricao']) }}">Eventos Abertos
                            para Inscrição</a></li>
                    <li role="presentation" class="@if($query == 'semInscricao') active @endif"><a
                                href="{{ route('eventosPublico::index', ['query' => 'semInscricao']) }}">Evento Abertos
                            sem Inscrição</a></li>
                    <li role="presentation" class="@if($query == 'finalizados') active @endif"><a
                                href="{{ route('eventosPublico::index', ['query' => 'finalizados']) }}">Eventos
                            Finalizados</a></li>
                </ul>
            </header>
            <section class="evento-conteiner">
                <div class="container">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3>Lista geral dos eventos</h3>
                        </div>
                        <div class="row">
                            @forelse($eventos as $evento)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="thumbnail">
                                        <img src="{{ asset($evento->eventoCaracteristica->logo) }}"
                                             alt="Logo do evento" width="30%" class="img-circle">
                                        <div class="caption">
                                            <h3>{{ $evento->nome }}</h3>
                                            <p class="non-paragrafo">Data do
                                                Evento: {{ $evento->dataInicio->day }}
                                                de {{ $evento->dataInicio->formatLocalized('%B')}}
                                                de {{ $evento->dataInicio->year }}</p>
                                            <p class="non-paragrafo">Fim do
                                                Evento: {{ $evento->dataTermino->day }}
                                                de {{ $evento->dataTermino->formatLocalized('%B')}}
                                                de {{ $evento->dataTermino->year }} </p>
                                            <p class="non-paragrafo">
                                                Inscrições: {{ $evento->dataInicioInscricao->day }}
                                                de {{ $evento->dataInicioInscricao->formatLocalized('%B')}}
                                                de {{ $evento->dataInicioInscricao->year }}
                                                até
                                                {{ $evento->dataFimInscricao->day }}
                                                de {{ $evento->dataFimInscricao->formatLocalized('%B')}}
                                                de {{ $evento->dataFimInscricao->year}} </p>
                                            <p>
                                                <a href="{{ route('eventosPublico::atividadesEvento', ['nomeSlug' => $evento->nomeSlug]) }}"
                                                   class="button button-orange" role="button">Atividades</a>
                                                <a href="{{ route('eventosPublico::visualizar', ['nomeSlug' => $evento->nomeSlug]) }}"
                                                   class="button button-blue" role="button">Evento</a>
                                                @if (!Auth::guest())
                                                    @if(!$evento->isParticipante(Auth::user()->id) && \Carbon\Carbon::now()->between($evento->dataInicioInscricao, $evento->dataFimInscricao))
                                                        {{ Form::open(['url' => route('eventosPublico::participar', ['nomeSlug' => $evento->nomeSlug]), 'method' => 'POST']) }}
                                                        <button class="button button-green" type="submit">
                                                            <i class="fa fa-plus" aria-hidden=""></i> Participar
                                                        </button>
                                                        {{ Form::close() }}
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="espacos"></div>
                                    <p class="paragrafo text-justify">
                                        Não há eventos para serem mostrados
                                    </p>
                                </div>
                            @endforelse
                        </div>
                        {{ $eventos->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
