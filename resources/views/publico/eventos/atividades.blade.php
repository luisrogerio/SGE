@extends('layouts.eventoPublico')
@section('title', "- Eventos")
@section('content')

    <div class="row">
        <div class="conteiner">
            <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                <h2>Lista de Atividades do evento {{ $evento->nome }} e subeventos:</h2>
                <form action="#" class="form-group">
                    <div class="input-group input-group-select form-group">
                        <input type="text" name="pesquisar" class="form-control" placeholder="Busca...">
                        <select name="pesquisa" class="form-control">
                            <option value="subevento">Subevento</option>
                            <option value="curso">Curso</option>
                        </select>
                    </div>
                    <button type="submit" class="button button-cyan"><i class="fa fa-search" aria-hidden="true"></i>
                        Pesquisar
                    </button>
                </form>
                <hr/>
                <h3>Evento: {{$evento->nome}}</h3>
                <div class="row" id="{{$evento->nomeSlug}}">
                    @foreach($evento->atividades as $atividade)
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
                                    <a href="#" class="button button-green"><i class="fa fa-plus"></i> Registrar</a>
                                    <div class="espacos"></div>
                                </div>
                            </div>
                            <div class="espacos"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
