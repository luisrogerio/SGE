@extends('layouts.layout')
@section('title', 'Eventos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'eventos/salvar', 'files' => true))}}
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
                                {{Form::label('eventos[nome]', 'Nome')}}
                                {{Form::text('eventos[nome]', null, array('class' => 'form-control'))}}
                                @if ($errors->has('eventos.nome')) <p class="help-block">{{ $errors->first('eventos.nome') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos[descricao]', 'Descrição')}}
                                {{Form::textarea('eventos[descricao]', null, array('class' => 'form-control'))}}
                                @if ($errors->has('eventos.descricao')) <p class="help-block">{{ $errors->first('eventos.descricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos[dataInicioInscricao]', 'Data de Início da Inscrição')}}
                                {{Form::date('eventos[dataInicioInscricao]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataInicioInscricao')) <p class="help-block">{{ $errors->first('eventos.dataInicioInscricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos[dataFimInscricao]', 'Data de Término da Inscrição')}}
                                {{Form::date('eventos[dataFimInscricao]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataFimInscricao')) <p class="help-block">{{ $errors->first('eventos.dataFimInscricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos[dataInicio]', 'Data de Início do Evento')}}
                                {{Form::date('eventos[dataInicio]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataInicio')) <p class="help-block">{{ $errors->first('eventos.dataInicio') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventos[dataTermino]', 'Data de Término do Evento')}}
                                {{Form::date('eventos[dataTermino]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventos.dataTermino')) <p class="help-block">{{ $errors->first('eventos.dataTermino') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventosContatos[]', 'Contato(s)')}}
                                {{Form::select('eventosContatos[]', $contatos, null, array('class' => 'form-control eventosContatos', 'multiple')) }}
                                @if ($errors->has('eventosContatos.*')) <p class="help-block">{{ $errors->first('eventosContatos.*') }}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                    <div role="tabpanel1" class="tab-pane fade" id="caracteristica">
                        <div class="well">
                            <fieldset class="checkbox form-group">
                                <label for="eventosCaracteristicas[eEmiteCertificado]">
                                    {{Form::checkbox('eventosCaracteristicas[eEmiteCertificado]', true, true,  array('id' => 'eventosCaracteristicas[eEmiteCertificado')) }} O evento emitirá Certificado?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.eEmiteCertificado')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.eEmiteCertificado') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventosCaracteristicas[dataLiberacaoCertificado]', 'Data de Liberação de Certificado')}}
                                {{Form::date('eventosCaracteristicas[dataLiberacaoCertificado]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}
                                @if ($errors->has('eventosCaracteristicas.dataLiberacaoCertificado')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.dataLiberacaoCertificado') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventosCaracteristicas[eExistemImagens]">
                                    {{Form::checkbox('eventosCaracteristicas[eExistemImagens]', true, true,  array('id' => 'eventosCaracteristicas[eExistemImagens]')) }} O evento guardará uma galeria de fotos?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.eExistemImagens')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.eExistemImagens') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventosCaracteristicas[eExistemNoticias]">
                                    {{Form::checkbox('eventosCaracteristicas[eExistemNoticias]', true, true,  array('id' => 'eventosCaracteristicas[eExistemNoticias]')) }} O evento possuirá notícias?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.eExistemNoticias')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.eExistemNoticias') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventosCaracteristicas[eAcademico]">
                                    {{Form::checkbox('eventosCaracteristicas[eAcademico]', true, true,  array('id' => 'eventosCaracteristicas[eAcademico]')) }} É um evento acadêmico?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.eAcademico.')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.eAcademico') }}</p> @endif
                            </fieldset>
                            <fieldset class="checkbox">
                                <label for="eventosCaracteristicas[ePropostaAtividade]">
                                    {{Form::checkbox('eventosCaracteristicas[ePropostaAtividade]', true, true,  array('id' => 'eventosCaracteristicas[ePropostaAtividade]')) }} O evento aceitará propostas de atividades?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.ePropostaAtividade')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.ePropostaAtividade') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventosCaracteristicas[idAparencias]', 'Tema')}}
                                {{Form::select('eventosCaracteristicas[idAparencias]', $temas, null, array('class' => 'form-control')) }}
                                @if ($errors->has('eventosCaracteristicas.idAparencias')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.idAparencias') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('eventosCaracteristicas[logoImagem]', 'Logo')}}
                                {!! Form::file('eventosCaracteristicas[logoImagem]') !!}
                                @if ($errors->has('eventosCaracteristicas.logoImagem')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.logoImagem') }}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
    <script type="application/javascript">
        $('.eventosContatos').select2({
            theme: 'bootstrap'
        });
    </script>
@endsection