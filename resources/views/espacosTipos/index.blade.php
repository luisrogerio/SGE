@extends('layouts.layout_admin')
@section('title', 'Tipos de Espaço')
@section('content')

    <h1>Tipos de Espaço</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($espacosTipos as $espacoTipo)
            <tr>
                <td>{{$espacoTipo->nome}}</td>
                <td class="text-center">{{link_to_route('espacosTipos::editar','Editar',['id'=>$espacoTipo->id], ['class' => 'button button-blue'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('espacosTipos::excluir', ['id' => $espacoTipo->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-red' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Tipo de Espaço"
                            data-message='Você tem certeza que deseja deletar esse tipo de usuário?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                {{link_to_route('espacosTipos::adicionar','Adicionar Novo', null, ['class' => 'button button-blue'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$espacosTipos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
