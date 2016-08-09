@extends('layouts.layout')
@section('title', 'Visualizar Evento')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{$evento->nome}}</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <h4 class="text-center">Data do Evento</h4>
                    <p class="h3 text-center">
                        {{ $evento->dataInicio->day }}
                        <small>de </small>
                            <span class="h4 text-capitalize">
                            {{ $evento->dataInicio->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataInicio->year }}
                    </p>
                    <p class="text-center text-capitalize">até</p>
                    <p class="h3 text-center">
                        {{ $evento->dataTermino->day }}
                        <small>de </small>
                        <span class="h4 text-capitalize">
                            {{ $evento->dataTermino->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataTermino->year }}
                    </p>
                    <hr>
                    <h4 class="text-center">Data de Inscrição</h4>
                    <p class="h3 text-center">
                        {{ $evento->dataInicioInscricao->day }}
                        <small>de </small>
                        <span class="h4 text-capitalize">
                            {{ $evento->dataInicioInscricao->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataInicioInscricao->year }}
                    </p>
                    <p class="text-center text-capitalize">até</p>
                    <p class="h3 text-center">
                        {{ $evento->dataFimInscricao->day }}
                        <small>de </small>
                        <span class="h4 text-capitalize">
                            {{ $evento->dataFimInscricao->formatLocalized('%B')}}
                            </span>
                        <br/>
                        <small> de</small>
                        {{ $evento->dataFimInscricao->year }}
                    </p>
                </div>
                <div class="col-xs-12 col-md-10">
                    <h4>Características</h4>
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
                    @if( $evento->eventoEdicaoAnterior != null)
                        <h4>Edição Anterior</h4>
                        {{ link_to_action('EventosController@getVisualizar', $evento->eventoEdicaoAnterior->nome , array('id' => $evento->eventoEdicaoAnterior->id)) }}
                    @endif
                    <h4>Contatos</h4>
                    <div class="row">
                        @foreach($evento->eventosContatos as $eventoContato)
                            <div class="col-xs-12 col-md-6 col-lg-4">
                                <address>
                                    <strong>{{ $eventoContato->nome }}</strong><br>
                                    @if($eventoContato->telefone)
                                        Telefone: {{$eventoContato->telefone}}<br>
                                    @endif
                                    @if($eventoContato->telefone)
                                        Celular: {{$eventoContato->celular}}<br>
                                    @endif
                                    Email: {{ $eventoContato->email }}<br>
                                    @if($eventoContato->redesSociais[0])
                                        Facebook: {!! link_to($eventoContato->redesSociais[0]) !!}<br>
                                    @endif
                                    @if($eventoContato->redesSociais[1])
                                        Twitter: {{$eventoContato->redesSociais[1]}}<br>
                                    @endif
                                </address>
                            </div>
                        @endforeach
                    </div>
                    {{ link_to_action('EventosController@getEditar', 'Editar Evento', array('id' => $evento->id), array('class' => 'btn btn-default')) }}
                    {{ link_to_action('AtividadesController@getAdicionar', 'Adicionar Atividade', null, array('class' => 'btn btn-success')) }}

                </div>
            </div>
        </div>
    </div>

@endsection