@extends('layouts.layout_admin')
@section('title', 'Atividades')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Editar Atividade - {{ $atividade->nome }}</h3>
        </div>
        <div class="panel-body">
            {{Form::model($atividade, array('url'=>route('atividades::atualizar', ['id' => $atividade->id])))}}
            {{ method_field('PATCH') }}
            <div class="well">
                <fieldset class="form-group">
                    {{Form::label('nome', 'Nome')}}
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
                    {{Form::label('atividades[idCursos][]', 'Cursos')}}
                    {{Form::select('atividades[idCursos][]', $cursos, $cursosSelecionados,  array('class' => 'form-control idCursos', 'multiple'))}}

                    @if ($errors->has('atividades.idCursos[]')) <p
                            class="help-block">{{$errors->first('atividades.idCursos[]')}}</p> @endif
                </fieldset>
                <fieldset class="form-group">
                    {{Form::label('atividadesCursosDatas', 'Datas de Inscrição para os Cursos')}}
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            {{Form::text('atividadesCursos.dataInicio', $atividade->cursos->first()->pivot->dataInicio->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataInicioInscricao'))}}
                        </div>
                        <div class="col-md-6 col-xs-12">
                            {{Form::text('atividadesCursos.dataFim', $atividade->cursos->first()->pivot->dataFim->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataFimInscricao'))}}
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    {{ Form::label('unidadeLocalSala', 'Unidade/Local/Sala') }}
                    {{Form::select('atividades[unidades]', $unidades, $unidadesSelecionadas,
                        array('class' => 'form-control', 'placeholder' => 'Selecione uma Unidade', 'id' => 'selectUnidade'))}}
                    {{Form::select('atividades[locais]', array(), null,
                        array('class' => 'form-control', 'placeholder' => 'Selecione um Local', 'id' => 'selectLocal'))}}
                    {{Form::select('atividades[salas]', array(), null,
                        array('class' => 'form-control', 'placeholder' => 'Selecione uma Sala', 'id' => 'selectSala'))}}

                    @if ($errors->has('atividades.unidades')) <p
                            class="help-block">{{$errors->first('atividades.unidades')}}</p> @endif
                    @if ($errors->has('atividades.locais')) <p
                            class="help-block">{{$errors->first('atividades.locais')}}</p> @endif
                    @if ($errors->has('atividades.salas')) <p
                            class="help-block">{{$errors->first('atividades.salas')}}</p> @endif
                </fieldset>
                {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
                {{Form::close()}}
            </div>
            {{link_to_route('atividades::view','Voltar', ['id' => $atividade->id], ['class' => 'button button-green'])}}
        </div>
    </div>
    <script type="application/javascript">
        $('.idCursos').select2({
            theme: 'bootstrap'
        });

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
                        @if(old('atividades.locais') || $locaisSelecionados)
                        if (index == {{ old('atividades.locais') or $locaisSelecionados}}) {
                            selected = "selected";
                        }
                        @endif
                        selectLocais.append('<option ' + selected + ' value=' + index + '>' + element + '</option>');
                    });
                    @if(old('atividades.locais') || $locaisSelecionados)
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
                        @if(old('atividades.salas') || $salasSelecionados)
                        if (index == {{ old('atividades.salas') or $salasSelecionados }}) {
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
        @if($errors->any() || $unidadesSelecionadas)
        $('#selectUnidade').trigger('change');
        @endif
    </script>
@endsection