@extends('layouts.layoutPublicoAtividade')
@section('title', 'Atividades')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Nova Atividade - {{ $evento->titulo }}</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>route('salvarAtividadePublico')))}}
            <ul class="nav nav-tabs nav-justified" role="tablist">
                @if ($evento->eventoCaracteristica->ePropostaAtividade)
                    <li role="presentation" class="active">
                        <a href="#proponente" aria-controls="proponente" role="tab" data-toggle="tab">Proponente</a>
                    </li>
                @endif
                <li role="presentation"
                    @if (!$evento->eventoCaracteristica->ePropostaAtividade)
                    class="active"
                        @endif
                >
                    <a href="#atividade" aria-controls="atividade" role="tab" data-toggle="tab">Atividade</a>
                </li>
                <li role="presentation">
                    <a href="#horario" aria-controls="horario" role="tab" data-toggle="tab">Datas e Horários</a>
                </li>
            </ul>
            <div class="tab-content">
                @if ($evento->eventoCaracteristica->ePropostaAtividade)
                    <div role="tabpanel1" class="tab-pane fade in active" id="proponente">
                        <div class="well">
                            <fieldset class="form-group">
                                {{Form::label('comentarios[5]', 'Nome do Proponente')}}
                                {{Form::text('comentarios[5]', null, array('class' => 'form-control'))}}
                                @if ($errors->has('comentarios[5]')) <p
                                        class="help-block">{{ $errors->first('comentarios[5]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('comentarios[6]', 'Telefone celular do Proponente')}}
                                {{Form::text('comentarios[6]', null, array('class' => 'form-control', 'id' => 'telefoneProponente', 'maxlength' => '16', 'placeholder' => '(xx) xxx-xxx-xxx'))}}
                                @if ($errors->has('comentarios[6]')) <p
                                        class="help-block">{{ $errors->first('comentarios[6]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('comentarios[7]', 'E-mail do Proponente')}}
                                {{Form::email('comentarios[7]', null, array('class' => 'form-control'))}}
                                @if ($errors->has('comentarios[7]')) <p
                                        class="help-block">{{ $errors->first('comentarios[7]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('comentarios[8]', 'Campus de Lotação do Proponente')}}
                                {{Form::text('comentarios[8]', null, array('class' => 'form-control'))}}
                                @if ($errors->has('comentarios[8]')) <p
                                        class="help-block">{{ $errors->first('comentarios[8]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades[quantidadeResponsaveis]', 'Número de Ministrantes da Atividade')}}
                                {{Form::number('atividades[quantidadeResponsaveis]', "1", array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.quantidadeResponsaveis')) <p
                                        class="help-block">{{ $errors->first('quantidadeResponsaveis') }}</p> @endif
                            </fieldset>
                            <p class="paragrafo"><strong>Os ministrantes da atividade serão adicionados após propor a Atividade</strong></p>
                            {{ Form::button('Próximo', array('class' => 'button button-blue btnProximo')) }}
                        </div>
                    </div>
                @endif
                <div role="tabpanel1" class="tab-pane fade
                    @if (!$evento->eventoCaracteristica->ePropostaAtividade)
                        in active
                    @endif
                        " id="atividade">
                    <div class="well">
                        <fieldset class="form-group">
                            {{Form::label('nome', 'Título da Atividade')}}
                            {{Form::text('nome', null, array('class' => 'form-control'))}}
                            @if ($errors->has('nome')) <p
                                    class="help-block">{{ $errors->first('nome') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('quantidadeVagas', 'Quantidade de Vagas')}}
                            {{Form::number('quantidadeVagas', null, array('class' => 'form-control'))}}
                            @if ($errors->has('quantidadeVagas')) <p
                                    class="help-block">{{ $errors->first('quantidadeVagas') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('idAtividadesTipos', 'Tipo de Atividade')}}
                            {{Form::select('idAtividadesTipos', $atividadesTipos, null, array('class' => 'form-control'))}}
                            @if ($errors->has('idAtividadesTipos')) <p
                                    class="help-block">{{ $errors->first('idAtividadesTipos') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="comentarios[0]">Nome da Área de Conhecimento(<a target="_blank"
                                                                                        href="http://lattes.cnpq.br/documents/11871/24930/TabeladeAreasdoConhecimento.pdf/d192ff6b-3e0a-4074-a74d-c280521bd5f7">Tabela
                                    da CNPQ</a>)</label>
                            {{Form::text('comentarios[0]', null, array('class' => 'form-control'))}}
                            @if ($errors->has('comentarios[0]')) <p
                                    class="help-block">{{ $errors->first('comentarios[0]') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('descricao', 'Descrição')}}
                            {{Form::textarea('descricao', null, array('class' => 'form-control'))}}
                            @if ($errors->has('descricao')) <p
                                    class="help-block">{{ $errors->first('descricao') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('comentarios[9]', 'Objetivo')}}
                            {{Form::textarea('comentarios[9]', null, array('class' => 'form-control', 'maxlength' => 300))}}
                            @if ($errors->has('comentarios[9]')) <p
                                    class="help-block">{{ $errors->first('comentarios[9]') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('comentarios[1]', 'Justificativa')}}
                            {{Form::textarea('comentarios[1]', null, array('class' => 'form-control', 'maxlength' => 500))}}
                            @if ($errors->has('comentarios[1]')) <p
                                    class="help-block">{{ $errors->first('comentarios[1]') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('comentarios[2]', 'Público-Alvo')}}
                            {{Form::textarea('comentarios[2]', null, array('class' => 'form-control'))}}
                            @if ($errors->has('comentarios[2]')) <p
                                    class="help-block">{{ $errors->first('comentarios[2]') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('comentarios[3]', 'Recursos/Materiais')}}
                            {{Form::textarea('comentarios[3]', null, array('class' => 'form-control'))}}
                            @if ($errors->has('comentarios[3]')) <p
                                    class="help-block">{{ $errors->first('comentarios[3]') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('comentarios[4]', 'Metodologia')}}
                            {{Form::textarea('comentarios[4]', null, array('class' => 'form-control', 'maxlength' => 500))}}
                            @if ($errors->has('comentarios[4]')) <p
                                    class="help-block">{{ $errors->first('comentarios[4]') }}</p> @endif
                        </fieldset>
                        {{Form::button('Anterior', array('class' => 'button button-blue btnAnterior')) }}
                        {{ Form::button('Próximo', array('class' => 'button button-blue btnProximo')) }}
                    </div>
                </div>
                <div role="tabpanel1" class="tab-pane fade" id="horario">
                    <div class="well">
                        @if ($errors->has('atividades.data.*')) <p
                                class="help-block">{{$errors->first('atividades.data.*')}}</p> @endif
                        @if ($errors->has('atividades.horarioInicio.*')) <p
                                class="help-block">{{$errors->first('atividades.data.*')}}</p> @endif
                        @if ($errors->has('atividades.horarioTermino.*')) <p
                                class="help-block">{{$errors->first('atividades.data.*')}}</p> @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Horário Início/Horário Término</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaTempo">
                            @if(old('atividades_data'))
                                @foreach(old('atividades_data') as $key => $value)
                                    <tr>
                                        <td>
                                            {{Form::text('atividades.data['.$key.']', old('atividades_data.'.$key), array('class' => 'form-control', 'id' => 'dataAtividade'.($key+1))) }}
                                        </td>
                                        <td class="horarios">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    {{Form::text('atividades.horarioInicio['.$key.']', old('atividades_horarioInicio.'.$key), array('class' => 'form-control', 'id' => 'horaInicioAtividade'.($key+1)))}}
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    {{Form::text('atividades.horarioTermino['.$key.']', old('atividades_horarioTermino'.$key), array('class' => 'form-control', 'id' => 'horaTerminoAtividade'.($key+1)))}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        {{Form::text('atividades.data[0]', '', array('class' => 'form-control', 'id' => 'dataAtividade1')) }}
                                    </td>
                                    <td class="horarios">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                                {{Form::text('atividades.horarioInicio[0]', '12:00', array('class' => 'form-control', 'id' => 'horaInicioAtividade1'))}}
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                {{Form::text('atividades.horarioTermino[0]', '13:00', array('class' => 'form-control', 'id' => 'horaTerminoAtividade1'))}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>
                                    <a id="btnAdd" class="button button-blue">
                                        <span class="glyphicon-plus"></span>
                                    </a>
                                    <a id="btnMinus" class="button button-blue">
                                        <span class="glyphicon-minus"></span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{Form::hidden('idEventos', $evento->id) }}
                        {{Form::button('Anterior', array('class' => 'button button-blue btnAnterior')) }}
                        {{Form::submit('Propor', array('class' => 'button button-blue'))}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('#telefoneProponente').mask("(##) ###-###-###");
        @if(old('atividades_data'))
        @foreach(old('atividades_data') as $key => $value)
        $('#horaInicioAtividade{{ ($key+1) }}').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#horaTerminoAtividade{{ ($key+1) }}').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#dataAtividade{{ ($key+1)}}').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            minDate: '{{ $evento->dataInicio->format('m-d-Y') }}',
            maxDate: '{{ $evento->dataTermino->format('m-d-Y') }}'
        });
        $('#dataAtividade{{ ($key+1)}}').ready(function () {
            $dataHora = $('#dataAtividade{{ ($key+1)}}').data("DateTimePicker");
            $dataHora.date(moment($('#dataAtividade{{ ($key+1)}}').attr('value'), 'DD/MM/YYYY'));
        });
        @endforeach
        @else
        $('#horaInicioAtividade1').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#horaTerminoAtividade1').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#dataAtividade1').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            minDate: '{{ $evento->dataInicio->format('m-d-Y') }}',
            maxDate: '{{ $evento->dataTermino->format('m-d-Y') }}'
        });
        @endif
        $('#dataInicioInscricao').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            maxDate: '{{ $evento->dataFimInscricao->format('m-d-Y') }}',
            minDate: '{{ $evento->dataInicioInscricao->format('m-d-Y') }}'
        });
        $('#dataInicioInscricao').ready(function () {
            $dataHora = $('#dataInicioInscricao').data("DateTimePicker");
            $dataHora.date(moment($('#dataInicioInscricao').attr('value'), 'DD/MM/YYYY'));
        });
        $('#dataFimInscricao').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            minDate: '{{ $evento->dataInicioInscricao->format('m-d-Y') }}',
            maxDate: '{{ $evento->dataFimInscricao->format('m-d-Y') }}'
        });
        $('#dataFimInscricao').ready(function () {
            $dataHora = $('#dataFimInscricao').data("DateTimePicker");
            $dataHora.date(moment($('#dataFimInscricao').attr('value'), 'DD/MM/YYYY'));
        });

        $('.btnProximo').click(function () {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });

        $('.btnAnterior').click(function () {
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
        var linha = 1;
        $('#btnAdd').click(function () {
            if (linha == 0) {
                $('#btnMinus').removeClass('disabled');
            }
            linha++;
            var linhaCopiada =
                "<tr> <td> " +
                "<input class=\"form-control\" id=\"dataAtividade1\" name=\"atividades.data[]\" type=\"text\" value=\"\"> " +
                "<\/td> <td class=\"horarios\"> <div class=\"row\"> <div class=\"col-md-6 col-xs-12\"> " +
                "<input class=\"form-control\" id=\"horaInicioAtividade1\" name=\"atividades.horarioInicio[]\" " +
                "type=\"text\" value=\"12:00\"> <\/div> <div class=\"col-md-6 col-xs-12\"> " +
                "<input class=\"form-control\" id=\"horaTerminoAtividade1\" name=\"atividades.horarioTermino[]\" " +
                "type=\"text\" value=\"13:00\"> " +
                "<\/div> <\/div> " +
                "<\/td> " +
                "<\/tr>";

            var parentTr = $(this).parents('tr:first');
            novaLinha = $(linhaCopiada).insertBefore(parentTr);
            console.log(novaLinha);
            novoInputData =
                novaLinha.find('td')
                    .eq(0)
                    .find('input:first');
            novoInputData.attr('id', 'dataAtividade' + linha);
            novoInputData.datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'pt-br',
                minDate: '{{ $evento->dataInicio->format('m-d-Y') }}',
                maxDate: '{{ $evento->dataTermino->format('m-d-Y') }}'
            }).on('ready', function () {
                $dataHora = $(this).data("DateTimePicker");
                $dataHora.date(moment($(this).attr('value'), 'DD/MM/YYYY'));
            });

            novoInputHoraInicio =
                novaLinha.find('td')
                    .eq(1)
                    .find('input:first');
            novoInputHoraInicio.attr('id', 'horaInicioAtividade' + linha);
            novoInputHoraInicio.datetimepicker({
                format: 'HH:mm',
                locale: 'pt-br',
                stepping: 5
            });

            novoInputHoraTermino =
                novaLinha.find('td')
                    .eq(1)
                    .find('input:last');
            novoInputHoraTermino.attr('id', 'horaTerminoAtividade' + linha);
            novoInputHoraTermino.datetimepicker({
                format: 'HH:mm',
                locale: 'pt-br',
                stepping: 5
            });

        });
        $('#btnMinus').click(function () {
            //var parentTr = $(this).parents('tr:first');
            $('#tabelaTempo').find('tr:last').prev().remove();
            linha--;
            if (linha == 0) {
                $('#btnMinus').addClass('disabled');
            }
        });
    </script>
@endsection