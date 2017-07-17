@extends('layouts.layout')
@section('title', 'Atividade')
@section('content')
    <h1>Atividade</h1>
    <h2>{{ $atividade->nome }}</h2>

    <div class="btn-group">
        @if($atividade->evento->eventoCaracteristica->ePropostaAtividade)
            {{link_to_route('atividades::analisar', 'Aprovar', ['id' => $atividade->id, 'status' => 'Aprovar'], ['class' => 'btn btn-default']) }}
            {{link_to_route('atividades::analisar', 'Reprovar', ['id' => $atividade->id, 'status' => 'Aprovar'], ['class' => 'btn btn-default']) }}
        @endif
    </div>
    {{link_to_route('atividades::editar','Editar',['id'=>$atividade->id], ['class' => 'btn btn-primary'])}}

@endsection