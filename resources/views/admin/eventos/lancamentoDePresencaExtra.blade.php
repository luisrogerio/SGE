@extends('layouts.layout_admin')
@section('title', 'Atividade')
@section('content')
    <h1>Atividade do evento - {{ $atividade->evento->nome }}</h1>
    <h2>Atividade - {{ $atividade->nome }} - Lançamento de Presença Extra dos Participantes</h2>
    <div class="espacos"></div>
    <h3>Participantes - Busca</h3>
    <div class="row">
        {{ Form::open(['url' => route('eventos::lancamentoDePresencaExtra', ['id' => $atividade->id]), 'method' => 'GET']) }}
        <div class="col-xs-4">
            {{Form::label('buscaParticipante', 'Nome do Participante')}}
            <div class="input-group">
                {{ Form::text('buscaParticipante', null, ['class' => 'form-control', 'placeholder' => 'Ex.: José']) }}
                <span class="input-group-btn"><button class="btn btn-default" type="submit"><i
                                class="glyphicon glyphicon-search"></i></button></span>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <hr/>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th class="text-center">Presença</th>
        </tr>
        @forelse($usuariosNaoParticipantes as $participante)
            {{ Form::open(['url' => route('eventos::lancarPresencaExtra', ['id' => $atividade->id, 'idParticipante' => $participante->id])]) }}
            <tr>
                <td class="text-uppercase">{{$participante->nome}}</td>
                <td class="text-center">
                    {{ Form::submit('Inscrever/Presença', ['class' => 'button button-green']) }}
                </td>
            </tr>
            {{ Form::close() }}
        @empty
        @endforelse
    </table>
    <div class="btn-group">
        <a href="{{ route('eventos::relatoriosAtividade',['nomeSlug' => $atividade->evento->nomeSlug], ['style' => 'color:#fff;']) }}">
            <button type="button" class="button button-green">
                Voltar
            </button>
        </a>
        <div class="espacos"></div>
    </div>
@endsection