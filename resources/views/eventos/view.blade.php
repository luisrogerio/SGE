@extends('layouts.layout_admin')
@section('title', 'Visualizar Evento')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>@include('subeventos.eventoBreadcrumb')</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <div class="data-box">
                        <h4 class="text-center data-header">Data do Evento</h4>
                        <p class="h3 text-center">
                            {{ $evento->dataInicio->day }}
                            <small>de</small>
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
                            <small>de</small>
                            <span class="h4 text-capitalize">
                            {{ $evento->dataTermino->formatLocalized('%B')}}
                            </span>
                            <br/>
                            <small> de</small>
                            {{ $evento->dataTermino->year }}
                        </p>
                    </div>

                    <div class="data-box">
                        <h4 class="text-center data-header">Data de Inscrição</h4>
                        <p class="h3 text-center">
                            {{ $evento->dataInicioInscricao->day }}
                            <small>de</small>
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
                            <small>de</small>
                            <span class="h4 text-capitalize">
                            {{ $evento->dataFimInscricao->formatLocalized('%B')}}
                            </span>
                            <br/>
                            <small> de</small>
                            {{ $evento->dataFimInscricao->year }}
                        </p>
                    </div>

                </div>
                <div class="col-xs-12 col-md-10">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#caracteristica" aria-controls="caracteristica" role="tab"
                               data-toggle="tab"><h5>Evento</h5></a>
                        </li>
                        <li role="presentation">
                            <a href="#subeventos" aria-controls="subeventos" role="tab" data-toggle="tab">
                                <h5>Subeventos</h5>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="caracteristica">
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
                            ($evento->eventoCaracteristica->eSubmissaoArtigo)?
                            'list-group-item-success':
                            'list-group-item-danger'
                            }}">
                                    Submissão de Artigos
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
                            <div class="container">
                                <div class="row">
                                    @if(!$evento->eventoCaracteristica->eImagemDeFundo)
                                        <h3>Cor de Fundo: <i class="fa fa-square
                                                @if(!$evento->eventoCaracteristica->eImagemDeFundo)
                                                    style=" background-color:
                                                             {{ $evento->eventoCaracteristica->backgroundColor }}
                                                             ;"
                                            @endif" aria-hidden="true"></i></h3>
                                    @else
                                        <div class="img-thumbnail" width="256px">
                                            {{ Html::image('/uploads/eventos/'.$evento->id.'/'.$evento->eventoCaracteristica->background, null, array('class' => 'img-responsive')) }}
                                        </div>
                                    @endif

                                </div>
                            </div>

                            @if( $evento->eventoEdicaoAnterior != null)
                                <h4>Edição Anterior</h4>
                                {{ link_to_route('eventos::visualizar', $evento->eventoEdicaoAnterior->nome , array('id' => $evento->eventoEdicaoAnterior->id)) }}
                            @endif
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <h3>Contatos</h3>
                                                @foreach($evento->eventosContatos as $eventoContato)
                                                    <p>
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
                                                            Facebook: {!! link_to($eventoContato->redesSociais[0]) !!}
                                                            <br>
                                                        @endif
                                                        @if($eventoContato->redesSociais[1])
                                                            Twitter: {{$eventoContato->redesSociais[1]}}<br>
                                                        @endif
                                                    </address>
                                                    </p>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h3>Links Externos
                                    <small><i class="glyphicon glyphicon-link" aria-hidden="true"></i></small>
                                </h3>
                                <div id="linksExternos">
                                    @foreach($evento->linksExternos as $linkExterno)
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">{{$linkExterno->descricao}}</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {{ Html::link($linkExterno->url) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <button class="button button-cyan" type='button' data-toggle="modal"
                                        data-target="#modalLinkExterno"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Adicionar Link Externo
                                </button>
                            </div>

                            <hr>
                            <div class="btn-group">
                                {{ link_to_route('eventos::editar', 'Editar Evento', array('id' => $evento->id), array('class' => 'button button-blue')) }}
                                @if ($evento->eventoPai == null)
                                    {{ link_to_route('eventos::adicionarSubevento', 'Adicionar Subevento', array('idPai' => $evento->id), array('class' => 'button button-blue')) }}
                                @endif
                                {{ link_to_route('atividades::index', 'Visualizar Atividades', ['idEventos' => $evento->id], array('class' => 'button button-blue')) }}
                                {{ link_to_route('eventosNoticias::index', 'Notícias', ['idEventos' => $evento->id], array('class' => 'button button-blue')) }}
                                {{link_to_route('eventos::index','Voltar', null, ['class' => 'button button-green'])}}
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="subeventos">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Subeventos</h4>
                                </div>
                                <div class="panel-body" id="subeventosPaginacao">
                                    @include('subeventos.subeventos')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalLinkExterno">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Novo Link Externo</h4>
                </div>
                {{Form::open(array('url' => route('eventos::salvarLinkExterno'), 'id' => 'adicionarLinkExterno'))}}
                <div class="modal-body">
                    <fieldset class="form-group" id="descricao">
                        {{Form::label('descricao', 'Descrição')}}
                        {{Form::text('descricao', null, array('class' => 'form-control', 'id' => 'descricaoInput'))}}
                        <p class="help-block"></p>
                    </fieldset>
                    <fieldset class="form-group" id="url">
                        {{Form::label('url', 'URL')}}
                        <div class="input-group">
                            {{Form::url('url', null, array('class' => 'form-control', 'id' => 'urlInput'))}}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span> </span>
                        </div>
                        <p class="help-block"></p>
                    </fieldset>
                    {{ Form::hidden('idEventos', $evento->id) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-orange" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="button button-blue">Salvar</button>
                </div>
                {{Form::close()}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                getSubeventos($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        $('#modalLinkExterno').on('hide.bs.modal', function () {
            $('#modalLinkExterno').removeData();
        })

        function getSubeventos(page) {
            $.ajax({
                url: $(document).attr('URL') + '?page=' + page,
                dataType: 'json',
            }).done(function (data) {
                $('#subeventosPaginacao').fadeOut('slow', function () {
                    $('#subeventosPaginacao').html(data);
                    $('#subeventosPaginacao').fadeIn('slow');
                });
            }).fail(function () {
                alert('Os subeventos não puderam ser carregados');
            });
        }

        $(function () {
            $('#adicionarLinkExterno').on('submit', function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                e.preventDefault(e);
                $.ajax({
                    type: "POST",
                    url: '{{ route('eventos::salvarLinkExterno') }}',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function () {
                        $("#linksExternos").append(
                            '<p><strong>' + $("#descricaoInput").val() + '</strong></p>' +
                            '<p><a href="' + $("#urlInput").val() + '">' + $("#urlInput").val() + '</a></p>');
                        $("#descricaoInput").val('');
                        $("#urlInput").val('');
                        $('#descricao p').text("");
                        $('#url p').text("");
                        $("#modalLinkExterno").modal('toggle');
                    },
                    error: function (data) {
                        var erro = data.responseJSON;
                        var descricao = "", url = "";
                        if (erro.descricao !== undefined) {
                            descricao = erro.descricao;
                        }
                        if (erro.url !== undefined) {
                            url = erro.url;
                        }
                        $("#descricao p").text(descricao);
                        $("#url p").text(url);
                    }
                })
            });
        });
    </script>
@endsection