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
                                @if ($errors->has('descricao')) <p class="help-block">{{ $errors->first('descricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('idEdicaoAnterior', 'Edição Anterior')}}
                                {{Form::select('idEdicaoAnterior', $edicoesAnteriores, null, array('class' => 'form-control', 'placeholder' => 'Selecione o Evento de Edição Anterior (Opcional)'))}}
                                @if ($errors->has('idEdicaoAnterior')) <p class="help-block">{{ $errors->first('idEdicaoAnterior') }}</p> @endif
                            </fieldset>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        {{Form::label('dataInicioInscricao', 'Data de Início da Inscrição')}}
                                        {{Form::text('dataInicioInscricao', null, array('class' => 'form-control', 'id'=>'dataInicioInscricao')) }}
                                        @if ($errors->has('dataInicioInscricao')) <p class="help-block">{{ $errors->first('dataInicioInscricao') }}</p> @endif
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        {{Form::label('dataFimInscricao', 'Data de Término da Inscrição')}}
                                        {{Form::text('dataFimInscricao', null, array('class' => 'form-control', 'id' => 'dataFimInscricao')) }}
                                        @if ($errors->has('dataFimInscricao')) <p class="help-block">{{ $errors->first('dataFimInscricao') }}</p> @endif
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        {{Form::label('dataInicio', 'Data de Início do Evento')}}
                                        {{Form::text('dataInicio', null, array('class' => 'form-control', 'id'=> 'dataInicio')) }}
                                        @if ($errors->has('dataInicio')) <p class="help-block">{{ $errors->first('dataInicio') }}</p> @endif
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        {{Form::label('dataTermino', 'Data de Término do Evento')}}
                                        {{Form::text('dataTermino', null, array('class' => 'form-control', 'id' => 'dataTermino')) }}
                                        @if ($errors->has('dataTermino')) <p class="help-block">{{ $errors->first('dataTermino') }}</p> @endif
                                    </fieldset>
                                </div>
                            </div>
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
                                <label for="eEmiteCertificado">
                                    {{Form::checkbox('eventosCaracteristicas[eEmiteCertificado]', true, true,  array('id' => 'eEmiteCertificado')) }} O evento emitirá Certificado?
                                </label>
                                @if ($errors->has('eventosCaracteristicas.eEmiteCertificado')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.eEmiteCertificado') }}</p> @endif
                            </fieldset>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        {{Form::label('dataLiberacaoCertificado', 'Data de Liberação de Certificado')}}
                                        {{Form::text('eventosCaracteristicas[dataLiberacaoCertificado]', null, array('class' => 'form-control', 'id' => 'dataLiberacaoCertificado')) }}
                                        @if ($errors->has('eventosCaracteristicas.dataLiberacaoCertificado')) <p class="help-block">{{ $errors->first('eventosCaracteristicas.dataLiberacaoCertificado') }}</p> @endif
                                    </fieldset>
                                </div>
                            </div>
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
                            <fieldset class="form-group form-inline">
                                {{Form::label('planoDeFundo', 'Plano de Fundo')}}
                                <label for="planoDeFundoCor">
                                    {{Form::radio('planoDeFundo', true, true, array('id' => 'planoDeFundoCor'))}} Cor de Fundo
                                </label>
                                <label for="planoDeFundoImagem">
                                    {{Form::radio('planoDeFundo', true, false, array('id' => 'planoDeFundoImagem'))}} Imagem de Fundo
                                </label>
                            </fieldset>
                            <div id="planoDeFundo" class="form-group">
                                {{Form::color('eventosCaracteristicas[backgroundColor]', null, array('class' => 'form-control'))}}
                                {{Form::file('eventosCaracteristicas[background]', array('style' => 'display:none'))}}
                            </div>
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
        $('#planoDeFundoCor').on('click', function(){
            $('#planoDeFundo').find('input[type="color"]').fadeIn();
            $('#planoDeFundo').find('input[type="file"]').fadeOut();
        });
        $('#planoDeFundoImagem').on('click', function(){
            $('#planoDeFundo').find('input[type="color"]').fadeOut();
            $('#planoDeFundo').find('input[type="file"]').fadeIn();
        });
        $('#eEmiteCertificado').on('change', function(){
            if($(this).is(':checked')){
                $('#dataLiberacaoCertificado').attr('disabled', null);
            } else {
                $('#dataLiberacaoCertificado').attr('disabled', 'disabled');
            }
        });

        $(function() {
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
            if($('#dataInicioInscricao').attr('value')){
                $dataHora = $('#dataInicioInscricao').data("DateTimePicker");
                $dataHora.date(moment($('#dataInicioInscricao').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if($('#dataFimInscricao').attr('value')){
                $dataHora = $('#dataFimInscricao').data("DateTimePicker");
                $dataHora.date(moment($('#dataFimInscricao').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if($('#dataInicio').attr('value')){
                $dataHora = $('#dataInicio').data("DateTimePicker");
                $dataHora.date(moment($('#dataInicio').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if($('#dataTermino').attr('value')){
                $dataHora = $('#dataTermino').data("DateTimePicker");
                $dataHora.date(moment($('#dataTermino').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
            if($('#dataLiberacaoCertificado').attr('value')){
                $dataHora = $('#dataLiberacaoCertificado').data("DateTimePicker");
                $dataHora.date(moment($('#dataLiberacaoCertificado').attr('value'), 'DD/MM/YYYY HH:mm'));
            }
        });

    </script>
@endsection

















