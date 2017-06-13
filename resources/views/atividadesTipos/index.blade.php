@extends('layouts.layout')
@section('title', 'Tipos de Atividade')
@section('content')

    <h1>Tipos de Atividade</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($atividadesTipos as $atividadeTipo)
            <tr>
                <td>{{$atividadeTipo->nome}}</td>
                <td class="text-center">{{link_to_route('atividadesTipos::editar','Editar',['id'=>$atividadeTipo->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'atividadesTipos/excluir/'.$atividadeTipo->id, 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Tipo de Atividade"
                            data-message='Você tem certeza que deseja deletar esse tipo de atividade?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_route('atividadesTipos::adicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$atividadesTipos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
