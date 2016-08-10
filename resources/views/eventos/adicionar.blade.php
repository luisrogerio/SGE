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
                            {{Form::label('nome', 'Nome')}}
                            {{Form::text('nome', null, array('class' => 'form-control'))}}
                            @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('descricao', 'Descrição')}}
                            {{Form::textarea('descricao', null, array('class' => 'form-control'))}}
                            @if ($errors->has('descricao')) <p
                                    class="help-block">{{ $errors->first('descricao') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('idEdicaoAnterior', 'Edição Anterior')}}
                            {{Form::select('idEdicaoAnterior', $edicoesAnteriores, null, array('class' => 'form-control', 'placeholder' => 'Selecione o Evento de Edição Anterior (Opcional)'))}}
                            @if ($errors->has('idEdicaoAnterior')) <p
                                    class="help-block">{{ $errors->first('idEdicaoAnterior') }}</p> @endif
                        </fieldset>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    {{Form::label('dataInicioInscricao', 'Data de Início da Inscrição')}}
                                    {{Form::text('dataInicioInscricao', null, array('class' => 'form-control', 'id'=>'dataInicioInscricao')) }}
                                    @if ($errors->has('dataInicioInscricao')) <p
                                            class="help-block">{{ $errors->first('dataInicioInscricao') }}</p> @endif
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    {{Form::label('dataFimInscricao', 'Data de Término da Inscrição')}}
                                    {{Form::text('dataFimInscricao', null, array('class' => 'form-control', 'id' => 'dataFimInscricao')) }}
                                    @if ($errors->has('dataFimInscricao')) <p
                                            class="help-block">{{ $errors->first('dataFimInscricao') }}</p> @endif
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    {{Form::label('dataInicio', 'Data de Início do Evento')}}
                                    {{Form::text('dataInicio', null, array('class' => 'form-control', 'id'=> 'dataInicio')) }}
                                    @if ($errors->has('dataInicio')) <p
                                            class="help-block">{{ $errors->first('dataInicio') }}</p> @endif
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    {{Form::label('dataTermino', 'Data de Término do Evento')}}
                                    {{Form::text('dataTermino', null, array('class' => 'form-control', 'id' => 'dataTermino')) }}
                                    @if ($errors->has('dataTermino')) <p
                                            class="help-block">{{ $errors->first('dataTermino') }}</p> @endif
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            {{Form::label('eventosContatos[]', 'Contato(s)')}}
                            {{Form::select('eventosContatos[]', $contatos, null, array('class' => 'form-control eventosContatos', 'multiple')) }}
                            @if ($errors->has('eventosContatos.*')) <p
                                    class="help-block">{{ $errors->first('eventosContatos.*') }}</p> @endif
                        </fieldset>
                    </div>
                </div>
                <div role="tabpanel1" class="tab-pane fade" id="caracteristica">
                    <div class="well">
                        <fieldset class="checkbox form-group">
                            <label for="eEmiteCertificado">
                                {{Form::checkbox('eventoCaracteristica[eEmiteCertificado]', true, true,  array('id' => 'eEmiteCertificado')) }}
                                O evento emitirá Certificado?
                            </label>
                            @if ($errors->has('eventoCaracteristica.eEmiteCertificado')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.eEmiteCertificado') }}</p> @endif
                        </fieldset>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    {{Form::label('dataLiberacaoCertificado', 'Data de Liberação de Certificado')}}
                                    {{Form::text('eventoCaracteristica[dataLiberacaoCertificado]', null, array('class' => 'form-control', 'id' => 'dataLiberacaoCertificado')) }}
                                    @if ($errors->has('eventoCaracteristica.dataLiberacaoCertificado')) <p
                                            class="help-block">{{ $errors->first('eventoCaracteristica.dataLiberacaoCertificado') }}</p> @endif
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="checkbox">
                            <label for="eventoCaracteristica[eExistemImagens]">
                                {{Form::checkbox('eventoCaracteristica[eExistemImagens]', true, true,  array('id' => 'eventoCaracteristica[eExistemImagens]')) }}
                                O evento guardará uma galeria de fotos?
                            </label>
                            @if ($errors->has('eventoCaracteristica.eExistemImagens')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.eExistemImagens') }}</p> @endif
                        </fieldset>
                        <fieldset class="checkbox">
                            <label for="eventoCaracteristica[eExistemNoticias]">
                                {{Form::checkbox('eventoCaracteristica[eExistemNoticias]', true, true,  array('id' => 'eventoCaracteristica[eExistemNoticias]')) }}
                                O evento possuirá notícias?
                            </label>
                            @if ($errors->has('eventoCaracteristica.eExistemNoticias')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.eExistemNoticias') }}</p> @endif
                        </fieldset>
                        <fieldset class="checkbox">
                            <label for="eventoCaracteristica[eAcademico]">
                                {{Form::checkbox('eventoCaracteristica[eAcademico]', true, true,  array('id' => 'eventoCaracteristica[eAcademico]')) }}
                                É um evento acadêmico?
                            </label>
                            @if ($errors->has('eventoCaracteristica.eAcademico.')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.eAcademico') }}</p> @endif
                        </fieldset>
                        <fieldset class="checkbox">
                            <label for="eventoCaracteristica[ePropostaAtividade]">
                                {{Form::checkbox('eventoCaracteristica[ePropostaAtividade]', true, true,  array('id' => 'eventoCaracteristica[ePropostaAtividade]')) }}
                                O evento aceitará propostas de atividades?
                            </label>
                            @if ($errors->has('eventoCaracteristica.ePropostaAtividade')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.ePropostaAtividade') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('eventoCaracteristica[idAparencias]', 'Tema')}}
                            {{Form::select('eventoCaracteristica[idAparencias]', $temas, null, array('class' => 'form-control')) }}
                            @if ($errors->has('eventoCaracteristica.idAparencias')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.idAparencias') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="eImagemDeFundo">
                                {{Form::checkbox('eventoCaracteristica[eImagemDeFundo]', 1, false, array('id' => 'eImagemDeFundo'))}}
                                Terá uma Imagem de Fundo
                            </label>
                        </fieldset>
                        <div class="form-group">
                            <div id="corDeFundo">
                                <label for="eventoCaracteristica[backgroundColor]">
                                    Cor de Fundo
                                </label>
                                {{Form::color('eventoCaracteristica[backgroundColor]', null, array('class' => 'form-control'))}}
                            </div>
                            <div id="planoDeFundo" style="display: none;">
                                <label for="eventoCaracteristica[backgroundImagem]">
                                    Imagem de Fundo
                                </label>
                                {{Form::file('eventoCaracteristica[backgroundImagem]')}}
                            </div>
                        </div>
                        <fieldset class="form-group">
                            {{Form::label('eventoCaracteristica[logoImagem]', 'Logo')}}
                            {!! Form::file('eventoCaracteristica[logoImagem]') !!}
                            @if ($errors->has('eventoCaracteristica.logoImagem')) <p
                                    class="help-block">{{ $errors->first('eventoCaracteristica.logoImagem') }}</p> @endif
                        </fieldset>
                    </div>
                </div>
            </div>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
    <script type="application/javascript">
        $(function () {
            $('.eventosContatos').select2({
                theme: 'bootstrap'
            });
            $('form input:checkbox[name="eventoCaracteristica[eImagemDeFundo]"]').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#corDeFundo').fadeOut();
                    $('#planoDeFundo').fadeIn();
                } else {
                    $('#corDeFundo').fadeIn();
                    $('#planoDeFundo').fadeOut();
                }
            });
            if ($('form input:checkbox[name="eventoCaracteristica[eImagemDeFundo]"]').is(':checked')) {
                $('#corDeFundo').fadeOut();
                $('#planoDeFundo').fadeIn();
            } else {
                $('#corDeFundo').fadeIn();
                $('#planoDeFundo').fadeOut();
            }
            $('#eEmiteCertificado').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#dataLiberacaoCertificado').attr('disabled', null);
                } else {
                    $('#dataLiberacaoCertificado').attr('disabled', 'disabled');
                }
            });
            if ($('#eEmiteCertificado').is(':checked')) {
                $('#dataLiberacaoCertificado').attr('disabled', null);
            } else {
                $('#dataLiberacaoCertificado').attr('disabled', 'disabled');
            }
            $('#dataInicioInscricao').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            $('#dataFimInscricao').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            $('#dataInicio').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            $('#dataTermino').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            $('#dataLiberacaoCertificado').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            if ($('#dataInicioInscricao').attr('value')) {
                $dataHora = $('#dataInicioInscricao').data("DateTimePicker");
                $dataHora.date(moment($('#dataInicioInscricao').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if ($('#dataFimInscricao').attr('value')) {
                $dataHora = $('#dataFimInscricao').data("DateTimePicker");
                $dataHora.date(moment($('#dataFimInscricao').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if ($('#dataInicio').attr('value')) {
                $dataHora = $('#dataInicio').data("DateTimePicker");
                $dataHora.date(moment($('#dataInicio').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if ($('#dataTermino').attr('value')) {
                $dataHora = $('#dataTermino').data("DateTimePicker");
                $dataHora.date(moment($('#dataTermino').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if ($('#dataLiberacaoCertificado').attr('value')) {
                $dataHora = $('#dataLiberacaoCertificado').data("DateTimePicker");
                $dataHora.date(moment($('#dataLiberacaoCertificado').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
        });
    </script>
@endsection

















