@extends('layouts.layout_admin')
@section('title', 'Grupo de Usuário')
@section('content')

    <h1>Grupos de Usuário</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($usuariosGrupos as $usuarioGrupo)
            <tr>
                <td>{{$usuarioGrupo->nome}}</td>
                <td class="text-center">{{ link_to_route('gruposdeusuario::editar','Editar',['id'=>$usuarioGrupo->id], ['class' => 'button button-blue'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('gruposdeusuario::excluir', ['id'=>$usuarioGrupo->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-red' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Grupo de Usuário"
                            data-message='Você tem certeza que deseja deletar esse Grupo de Usuário?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                {{ link_to_route('gruposdeusuario::adicionar','Adicionar Novo', null, ['class' => 'button button-blue'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$usuariosGrupos->links()}}
    @include('layouts.confirmarDelecao')
@endsection
