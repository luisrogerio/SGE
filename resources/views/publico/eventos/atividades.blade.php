@extends('layouts.eventoLayout')
@section('title', "- Eventos")
@section('content')
    <h1>{{ $evento->nome }}</h1>
    <h2>Lista de Atividades do evento e subeventos:</h2>
    <hr/>
    <h3>Evento: {{$evento->nome}}</h3>
    <div class="row" id="{{$evento->nomeSlug}}">
        @forelse($atividades as $atividade)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card">
                    <div class="container">
                        <h3><strong>{{ $atividade->nome }}</strong></h3>

                        <h4>
                            <small>Unidade:</small>
                            {{ $atividade->unidade->nome }}
                        </h4>
                        <h4>
                            <small>Local:</small>
                            {{ $atividade->local->nome }}
                        </h4>
                        <h4>
                            <small>Sala:</small>
                            {{ $atividade->sala->nome }}
                        </h4>
                        <h4>
                            Palestrantes:
                        </h4>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-3 col-md-3">
                                <ul>
                                    @foreach($atividade->atividadesResponsaveis as $atividadeResponsavel)
                                        <li>
                                            <h4>{{ $atividadeResponsavel->titulacao }}
                                                - {{ $atividadeResponsavel->nome }}</h4>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <h4>
                            <small>Datas:</small>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-3 col-md-3">
                                    <ul>
                                        @foreach($atividade->atividadesDatasHoras as $atividadeDataHora)
                                            <li>
                                                {{$atividadeDataHora->data->format("d/m/Y")}} de
                                                {{$atividadeDataHora->horarioInicio->format("H:i")}}h até
                                                {{$atividadeDataHora->horarioTermino->format("H:i")}}h
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </h4>
                        <div class="espacos"></div>
                        <a href="#" class="button button-cyan"><i class="fa fa-plus"></i> Saiba Mais</a>
                        @if(!$evento->isParticipante(Auth::user()->id))
                            <a href="#" class="button button-green"><i class="fa fa-plus"></i> Participar</a>
                        @endif
                        <div class="espacos"></div>
                    </div>
                </div>
                <div class="espacos"></div>
            </div>
        @empty
            <div>
                <p class="paragrafo">Não há atividades</p>
            </div>
        @endforelse
        {{$atividades->links()}}
    </div>
@endsection
