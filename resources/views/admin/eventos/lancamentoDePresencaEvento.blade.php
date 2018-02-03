@extends('layouts.layout_admin')
@section('title', 'Evento')
@section('content')
    <h1>Evento - {{ $evento->nome }} - Lançamento de Presença dos Participantes</h1>
    <div class="espacos"></div>
    <h3>Participantes</h3>
    {{ Form::open(['url' => route('eventos::lancarPresencaEvento', ['id' => $evento->id])]) }}
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th class="text-center">Presença</th>
        </tr>
        @foreach($evento->participantes as $participante)
            <tr>
                <td class="text-uppercase">{{$participante->nome}}</td>
                <td class="text-center">
                    {{ Form::checkbox('presenca[]', $participante->id, $participante->pivot->presenca, ['class' => 'input-group']) }}
                </td>
            </tr>
        @endforeach
    </table>
    <div class="btn-group">
        {{ Form::submit('Lançar Presenças', ['class' => 'button button-blue']) }}
        {{ Form::close() }}
        <a href="{{ route('eventos::visualizar',['id' => $evento->id], ['style' => 'color:#fff;']) }}">
            <button type="button" class="button button-green">
                Voltar
            </button>
        </a>
        <div class="espacos"></div>
    </div>
@endsection