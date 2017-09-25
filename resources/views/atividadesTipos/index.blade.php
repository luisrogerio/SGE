@extends('layouts.layout_admin')
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
                <td class="text-center">
                    {{ Form::open(array('method' => 'GET', 'url' => route('atividadesTipos::editar', ['id' => $atividadeTipo->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-blue' type='submit'>
                        Editar
                    </button>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('atividadesTipos::excluir', ['id' => $atividadeTipo->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Tipo de Atividade"
                            data-message='Você tem certeza que deseja deletar esse tipo de atividade?'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                {{link_to_route('atividadesTipos::adicionar','Adicionar Novo', null, ['class' => 'button button-green'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$atividadesTipos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
