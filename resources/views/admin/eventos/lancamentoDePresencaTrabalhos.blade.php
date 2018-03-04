@extends('layouts.layout_admin')
@section('title', 'Trabalho')
@section('content')
    <h1>Trabalhos do evento - {{ $evento->nome }} - Lançamento de Presença dos Autores/Apresentadores</h1>
    <div class="espacos"></div>
    <h3>Trabalhos</h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome do Trabalho</th>
            <th>Presença</th>
        </tr>
        @foreach ($trabalhos as $trabalho)
            <tr>
                <td class="text-uppercase">{{$trabalho->tituloTrabalho}}</td>
                <td class="text-center">
                    <a href="{{ route('eventos::lancamentoDePresencaTrabalho',['id' => $trabalho->idTrabalho], ['style' => 'color:#fff;']) }}">
                        <button type="button" class="button button-green">
                            Lançar
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="btn-group">
        <a href="{{ route('eventos::visualizar',['id' => $evento->id], ['style' => 'color:#fff;']) }}">
            <button type="button" class="button button-green">
                Voltar
            </button>
        </a>
        <div class="espacos"></div>
    </div>
@endsection