@extends('layouts.layout_admin')
@section('title', 'Responsável da Atividade')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Editar Data e Horário</h3>

        </div>
        {{ Form::model($atividadeDataHora, array('url' => route('atividades::atualizarDataHora', ['id' => $atividadeDataHora->id]))) }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <fieldset>
                <label for="data">Data</label>
                {{Form::text('data', $atividadeDataHora->data->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataAtividade')) }}
            </fieldset>
            <fieldset>
                <label for="horarioInicio">Horário de Início</label>
                {{Form::text('horarioInicio', $atividadeDataHora->horarioInicio->format('H:i'), array('class' => 'form-control', 'id' => 'horaInicioAtividade'))}}
            </fieldset>
            <fieldset>
                <label for="horarioTermino">Horário de Término</label>
                {{Form::text('horarioTermino', $atividadeDataHora->horarioTermino->format('H:i'), array('class' => 'form-control', 'id' => 'horaTerminoAtividade'))}}
            </fieldset>
        </div>
        {{Form::submit('Editar', array('class' => 'button button-blue'))}}
        <button class="button button-green">
                {{link_to_route('atividades::view','Voltar', ['id' => $atividadeDataHora->atividade->id], ['style' => 'color:#fff;'])}}
            </button>
        {{Form::close()}}
    </div>
    <script>
        $('#horaInicioAtividade').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#horaTerminoAtividade').datetimepicker({
            format: 'HH:mm',
            locale: 'pt-br',
            stepping: 5
        });
        $('#dataAtividade').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'pt-br',
            minDate: '{{ $atividadeDataHora->atividade->evento->dataInicio->startOfDay()->format('m-d-Y H:i') }}',
            maxDate: '{{ $atividadeDataHora->atividade->evento->dataTermino->format('m-d-Y H:i') }}',
            useCurrent: false
        });
    </script>
@endsection