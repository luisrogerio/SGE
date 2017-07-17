@extends('layouts.layout')
@section('title', 'Atividades')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Editar Atividade - {{ $atividade->nome }}</h3>
        </div>
        <div class="panel-body">
            {{Form::model($atividade, array('url'=>route('atividades::atualizar', ['id' => $atividade->id])))}}
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="#atividade" aria-controls="atividade" role="tab" data-toggle="tab">Atividade</a>
                </li>
                <li role="presentation">
                    <a href="#horario" aria-controls="horario" role="tab" data-toggle="tab">Datas e Horários</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel1" class="tab-pane fade in active" id="atividade">
                    <div class="well">
                        <fieldset class="form-group">
                            {{Form::label('nome', 'Nome')}}
                            {{Form::text('nome', null, array('class' => 'form-control'))}}
                            @if ($errors->has('nome')) <p
                                    class="help-block">{{ $errors->first('nome') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('idAtividadesTipos', 'Tipo de Atividade')}}
                            {{Form::select('idAtividadesTipos', $atividadesTipos, $atividadesTiposSelecionada, array('class' => 'form-control'))}}
                            @if ($errors->has('idAtividadesTipos')) <p
                                    class="help-block">{{ $errors->first('idAtividadesTipos') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('descricao', 'Descrição')}}
                            {{Form::textarea('descricao', null, array('class' => 'form-control'))}}
                            @if ($errors->has('descricao')) <p
                                    class="help-block">{{ $errors->first('descricao') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('funcaoResponsavel', 'Nome da Função do Responsável da Atividade')}}
                            {{Form::text('funcaoResponsavel', null, array('class' => 'form-control', 'placeholder' => 'Ex.: Palestrante ou Diretor da Mesa Redonda'))}}
                            @if ($errors->has('funcaoResponsavel')) <p
                                    class="help-block">{{ $errors->first('funcaoResponsavel') }}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('atividades[idCursos]', 'Cursos')}}
                            {{Form::select('atividades[idCursos]', $cursos, $cursosSelecionados,  array('class' => 'form-control idCursos', 'multiple'))}}

                            @if ($errors->has('atividades.idCursos')) <p
                                    class="help-block">{{$errors->first('atividades.idCursos')}}</p> @endif
                        </fieldset>
                        <fieldset class="form-group">
                            {{Form::label('atividadesCursosDatas', 'Datas de Inscrição para os Cursos')}}
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    {{Form::text('atividadesCursos.dataInicio', $atividade->evento->dataInicioInscricao->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataInicioInscricao'))}}
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    {{Form::text('atividadesCursos.dataFim', $atividade->evento->dataFimInscricao->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataFimInscricao'))}}
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            {{ Form::label('unidadeLocalSala', 'Unidade/Local/Sala') }}
                            {{Form::select('atividades[unidades]', $unidades, $unidadesSelecionadas,
                                array('class' => 'form-control', 'placeholder' => 'Selecione uma Unidade', 'id' => 'selectUnidade'))}}
                            {{Form::select('atividades[locais]', array(), $locaisSelecionados,
                                array('class' => 'form-control', 'placeholder' => 'Selecione um Local', 'id' => 'selectLocal'))}}
                            {{Form::select('atividades[salas]', array(), $salasSelecionados,
                                array('class' => 'form-control', 'placeholder' => 'Selecione uma Sala', 'id' => 'selectSala'))}}

                            @if ($errors->has('atividades.unidades')) <p
                                    class="help-block">{{$errors->first('atividades.unidades')}}</p> @endif
                            @if ($errors->has('atividades.locais')) <p
                                    class="help-block">{{$errors->first('atividades.locais')}}</p> @endif
                            @if ($errors->has('atividades.salas')) <p
                                    class="help-block">{{$errors->first('atividades.salas')}}</p> @endif
                        </fieldset>
                        {{ Form::button('Próximo', array('class' => 'btn btn-primary btnProximo')) }}
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
                            <tbody id="tabelaTempo">
                            @if($atividadesDataHoras)
                                @foreach($atividadesDataHoras as $key => $value)
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
                                    <a id="btnAdd" class="btn btn-default">
                                        <span class="glyphicon-plus"></span>
                                    </a>
                                    <a id="btnMinus" class="btn btn-default">
                                        <span class="glyphicon-minus"></span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{Form::button('Anterior', array('class' => 'btn btn-primary btnAnterior')) }}
                        {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('.idCursos').select2({
            theme: 'bootstrap'
        });
        @if($atividadesDataHoras)
            @foreach($atividadesDataHoras as $key => $value)
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
            minDate: '{{ $atividade->evento->dataInicio->format('m-d-Y') }}',
            maxDate: '{{ $atividade->evento->dataTermino->format('m-d-Y') }}'
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
            minDate: '{{ $atividade->evento->dataInicio->format('m-d-Y') }}',
            maxDate: '{{ $atividade->evento->dataTermino->format('m-d-Y') }}'
        });
        @endif
        $('#dataInicioInscricao').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            maxDate: '{{ $atividade->evento->dataFimInscricao->format('m-d-Y') }}',
            minDate: '{{ $atividade->evento->dataInicioInscricao->format('m-d-Y') }}'
        });
        $('#dataInicioInscricao').ready(function () {
            $dataHora = $('#dataInicioInscricao').data("DateTimePicker");
            $dataHora.date(moment($('#dataInicioInscricao').attr('value'), 'DD/MM/YYYY'));
        });
        $('#dataFimInscricao').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            minDate: '{{ $atividade->evento->dataInicioInscricao->format('m-d-Y') }}',
            maxDate: '{{ $atividade->evento->dataFimInscricao->format('m-d-Y') }}'
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
        $('#selectUnidade').on('change', function () {
            var idUnidade = $(this).val();
            if (idUnidade != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: '{{ route('locais::getLocais', null) }}/' + idUnidade
                }).done(function (locais) {
                    var selectLocais = $("#selectLocal");
                    selectLocais.empty();
                    locais = JSON.parse(locais);
                    selectLocais.append('<option value>Selecione um Local do ' + $('#selectUnidade option:selected').text() + '</option>');
                    $.each(locais, function (index, element) {
                        selected = "";
                        @if(old('atividades.locais'))
                        if (index == {{ old('atividades.locais') }}) {
                            selected = "selected";
                        }
                        @endif
                        selectLocais.append('<option ' + selected + ' value=' + index + '>' + element + '</option>');
                    });
                    @if(old('atividades.locais'))
                        $('#selectLocal').trigger('change');
                    @endif
                });
            } else {
                $("#selectLocal")
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value>Selecione um Local</option>');
                $("#selectSala")
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value>Selecione uma Sala</option>');
            }
        });
        $('#selectLocal').on('change', function () {
            var idLocal = $(this).val();
            if (idLocal != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: '{{ route('salas::getSalas', null) }}/' + idLocal
                }).done(function (salas) {
                    var selectSalas = $("#selectSala");
                    selectSalas.empty();
                    salas = JSON.parse(salas);
                    selectSalas.append('<option value>Selecione uma Sala do ' + $('#selectLocal option:selected').text() + '</option>');
                    $.each(salas, function (index, element) {
                        selected = "";
                        @if(old('atividades.salas'))
                        if (index == {{ old('atividades.salas') }}) {
                            selected = "selected";
                        }
                        @endif
                        selectSalas.append('<option ' + selected + ' value=' + index + '>' + element + '</option>');
                    });
                });
            } else {
                $("#selectSala")
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value>Selecione uma Sala</option>');
            }
        });
        @if($errors->any())
            $('#selectUnidade').trigger('change');
                @endif
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
                minDate: '{{ $atividade->evento->dataInicio->format('m-d-Y') }}',
                maxDate: '{{ $atividade->evento->dataTermino->format('m-d-Y') }}'
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