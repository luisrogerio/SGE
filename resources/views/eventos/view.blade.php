@extends('layouts.layout')
@section('title', 'Visualizar Evento')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{$evento->nome}}</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <h4>Data do Evento</h4>
                    <p class="h3 text-left">
                        {{ $evento->dataInicio->day }}
                        <small>de </small>
                            <span class="h4 text-capitalize">
                            {{ $evento->dataInicio->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataInicio->year }}
                    </p>
                    <p class="text-capitalize">até</p>
                    <p class="h3 text-left">
                        {{ $evento->dataTermino->day }}
                        <small>de </small>
                        <span class="h4 text-capitalize">
                            {{ $evento->dataTermino->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataTermino->year }}
                    </p>
                </div>
                <div class="col-md-10">
                    <h3>Data de Inscrição</h3>
                    <p>{{ $evento->dataInicioInscricao->formatLocalized('%d de %B de %Y')}} até
                        {{ $evento->dataFimInscricao->formatLocalized('%d de %B de %Y')}}
                    </p>
                    <h3>Características</h3>
                    <ul class="list-group">
                        <li class="list-group-item {{
                            ($evento->eventoCaracteristica->eEmiteCertificado)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                            Emissão de certificado.
                            {{
                            ($evento->eventoCaracteristica->eEmiteCertificado)?
                            'Data de Liberação do Certificado: '.$evento->eventoCaracteristica->dataLiberacaoCertificado->formatLocalized('%d de %B de %Y'):
                            ''
                            }}
                        </li>
                        <li class="list-group-item {{
                            ($evento->eventoCaracteristica->eExistemImagens)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                            Galeria de Imagens
                        </li>
                        <li class="list-group-item {{
                            ($evento->eventoCaracteristica->eExistemNoticias)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                            Notícias
                        </li>
                        <li class="list-group-item {{
                            ($evento->eventoCaracteristica->eAcademico)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                            Evento Acadêmico
                        </li>
                        <li class="list-group-item {{
                            ($evento->eventoCaracteristica->ePropostaAtividade)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                            Haverá Proposta de Atividade
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection