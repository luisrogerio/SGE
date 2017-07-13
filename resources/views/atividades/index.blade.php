@extends('layouts.layout')
@section('title', 'Atividade')
@section('content')
    <h1>Atividade</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($atividades as $atividade)
            <tr>
                <td>{{$atividade->nome}}</td>
                <td class="text-center">{{link_to_route('atividades::view','Visualizar',['id'=>$atividade->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('atividades::excluir', ['id' => $atividade->id]), 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Atividade"
                            data-message='Você tem certeza que deseja deletar essa atividade?'>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_route('atividades::adicionar','Adicionar Novo', ['id' => $evento->id], ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$atividades->links()}}
    @include('layouts.confirmarDelecao')
@endsection