@extends('layouts.layout')
@section('title', 'Atividade')
@section('content')
    <h1>Atividade</h1>
    <h2>{{ $atividade->nome }}</h2>
    <div class="btn-group">
        @if(dd($atividade->eventoCaracteristica->ePropostaAtividade))
            {{link_to_route('', 'Aprovar', ['id' => $atividade->id], ['class' => 'btn btn-default']) }}
            {{link_to_route('', 'Reprovar', ['id' => $atividade->id], ['class' => 'btn btn-default']) }}
            @endif
    </div>
    {{link_to_route('atividades::editar','Editar',['id'=>$atividade->id], ['class' => 'btn btn-primary'])}}

@endsection