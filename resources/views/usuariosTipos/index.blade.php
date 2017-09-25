@extends('layouts.layout_admin')
@section('title', 'Tipos de Usuário')
@section('content')

    <h1>Tipos de Usuário</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($usuariosTipos as $usuarioTipo)
            <tr>
                <td>{{$usuarioTipo->nome}}</td>
                <td class="text-center">{{link_to_route('usuariosTipos::editar','Editar',['id'=>$usuarioTipo->id], ['class' => 'button button-blue'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('usuariosTipos::excluir', ['id' => $usuarioTipo->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-red' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Tipo de Usuário"
                            data-message='Você tem certeza que deseja deletar esse tipo de usuário?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                {{link_to_route('usuariosTipos::adicionar','Adicionar Novo', null, ['class' => 'button button-blue'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$usuariosTipos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
