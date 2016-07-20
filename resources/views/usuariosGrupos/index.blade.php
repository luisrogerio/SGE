@extends('layouts.layout')
@section('title', 'Grupo de Usuário')
@section('content')

    <h1>Grupos de Usuário</h1>
    <table class="table table-striped table-bordered">
        <tr><th>Nome</th><th colspan="2" class="text-center">Opções</th></tr>
        @foreach($usuariosGrupos as $usuarioGrupo)
            <tr>
                <td>{{$usuarioGrupo->nome}}</td>
                <td class="text-center">{{link_to_action('UsuariosGruposController@getEditar','Editar',['id'=>$usuarioGrupo->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'gruposdeusuario/excluir/'.$usuarioGrupo->id, 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Grupo de Usuário" data-message='Você tem certeza que deseja deletar esse Grupo de Usuário?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_action('UsuariosGruposController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$usuariosGrupos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
