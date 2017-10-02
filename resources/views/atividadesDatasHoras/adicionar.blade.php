@extends('layouts.layout_admin') @section('title', 'Atividades Datas e Horários') @section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Adicionar Data e Horário</h3>
    </div>
    {{ Form::open(array('url' => route('atividades::salvarDataHora'))) }}
    <div class="panel-body">
        <fieldset>
            <label for="data">Data</label> {{Form::text('data', $atividade->evento->dataInicio->format('d/m/Y') , array('class'
            => 'form-control', 'id' => 'dataAtividade')) }}
        </fieldset>
        <fieldset>
            <label for="horarioInicio">Horário de Início</label> {{Form::text('horarioInicio', '12:00', array('class' =>
            'form-control', 'id' => 'horaInicioAtividade'))}}
        </fieldset>
        <fieldset>
            <label for="horarioTermino">Horário de Término</label> {{Form::text('horarioTermino', '13:00', array('class'
            => 'form-control', 'id' => 'horaTerminoAtividade'))}}
        </fieldset>
    </div>
    {{Form::hidden('idAtividade', $atividade->id)}} {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
    <button class="button button-green">
                {{link_to_route('atividades::view','Voltar', ['id' => $atividade->id], ['style' => 'color:#fff;'])}}
            </button> {{Form::close()}}
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
        minDate: '{{ $atividade->evento->dataInicio->format('
        m - d - Y H: i ') }}',
        maxDate: '{{ $atividade->evento->dataTermino->format('
        m - d - Y H: i ') }}',
        useCurrent: false
    });
</script>
@endsection