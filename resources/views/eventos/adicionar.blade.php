@extends('layouts.layout')
@section('title', 'Eventos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'eventos/salvar'))}}
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#evento" aria-controls="evento" role="tab" data-toggle="tab">Evento</a>
                    </li>
                    <li role="presentation">
                        <a href="#caracteristica" aria-controls="caracteristica" role="tab" data-toggle="tab">Caracteristicas</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel1" class="tab-pane fade in active" id="evento">
                        <div class="well">
                            <fieldset class="form-group">
                                {{Form::label('eventos.nome', 'Nome')}}
                                {{Form::text('eventos.nome', null, array('class' => 'form-control'))}}
                                @if ($errors->has('eventos.nome')) <p class="help-block">{{ $errors->first('eventos.nome') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos.descricao', 'Descrição')}}
                                {{Form::textarea('eventos.descricao', null, array('class' => 'form-control'))}}
                                @if ($errors->has('eventos.descricao')) <p class="help-block">{{ $errors->first('descricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos.dataInicioInscricao', 'Data de Início da Inscrição')}}
                                {{Form::date('eventos.dataInicioInscricao', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataInicioInscricao')) <p class="help-block">{{ $errors->first('dataInicioInscricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos.dataTerminoInscricao', 'Data de Término da Inscrição')}}
                                {{Form::date('eventos.dataTerminoInscricao', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataTerminoInscricao')) <p class="help-block">{{ $errors->first('dataTerminoInscricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos.dataInicio', 'Data de Início do Evento')}}
                                {{Form::date('eventos.dataInicio', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataInicio')) <p class="help-block">{{ $errors->first('dataInicio') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos.dataTermino', 'Data de Término do Evento')}}
                                {{Form::date('eventos.dataTermino', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataTermino')) <p class="help-block">{{ $errors->first('dataTermino') }}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                    <div role="tabpanel1" class="tab-pane fade" id="caracteristica">
                        <div class="well">
                            <fieldset class="checkbox form-group">
                                <label for="eventos_caracteristicas.eEmiteCertificado">
                                    {{Form::checkbox('eventos_caracteristicas.eEmiteCertificado', true, true,  array('id' => 'eventos_caracteristicas.eEmiteCertificado')) }} Emite Certificado?
                                </label>
                                @if ($errors->has('eventos_caracteristicas.eEmiteCertificado')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.eEmiteCertificado') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos_caracteristicas.dataLiberacaoCertificado', 'Data de Liberação de Certificado')}}
                                {{Form::date('eventos_caracteristicas.dataLiberacaoCertificado', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos_caracteristicas.dataLiberacaoCertificado')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.dataLiberacaoCertificado') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventos_caracteristicas.eExistemImagens">
                                    {{Form::checkbox('eventos_caracteristicas.eExistemImagens', true, true,  array('id' => 'eventos_caracteristicas.eExistemImagens')) }} Existem imagens?
                                </label>
                                @if ($errors->has('eventos_caracteristicas.eExistemImagens')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.eExistemImagens') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventos_caracteristicas.eExistemNoticias">
                                    {{Form::checkbox('eventos_caracteristicas.eExistemNoticias', true, true,  array('id' => 'eventos_caracteristicas.eExistemNoticias')) }} Exitem Notícias?
                                </label>
                                @if ($errors->has('eventos_caracteristicas.eExistemNoticias')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.eExistemNoticias') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventos_caracteristicas.eAcademico">
                                    {{Form::checkbox('eventos_caracteristicas.eAcademico', true, true,  array('id' => 'eventos_caracteristicas.eAcademico')) }} É Acadêmico?
                                </label>
                                @if ($errors->has('eventos_caracteristicas.eAcademico')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.eAcademico') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventos_caracteristicas.ePropostaAtividade">
                                    {{Form::checkbox('eventos_caracteristicas.ePropostaAtividade', true, true,  array('id' => 'eventos_caracteristicas.ePropostaAtividade')) }} Aceita propostas de atividades?
                                </label>
                                @if ($errors->has('eventos_caracteristicas.ePropostaAtividade')) <p class="help-block">{{ $errors->first('eventos_caracteristicas.ePropostaAtividade') }}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>

@endsection