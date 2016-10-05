@extends('layouts.layout')
@section('title', 'Tipos de Usuário')
@section('content')

<h1>Tipos de Usuário</h1>
<table class="table table-striped table-bordered">
    <tr><th>Nome</th><th colspan="3" class="text-center">Opções</th></tr>
@foreach($usuariosTipos as $usuarioTipo)
    <tr>
        <td>{{$usuarioTipo->nome}}</td>
        <td class="text-center">
            @if($usuarioTipo->conexaoExterna == null)
                {{link_to_action('ConexoesExternasController@getAdicionar', 'Criar Conexão com Banco Externo',
                ['idUsuarioTipo' => $usuarioTipo->id], array('class' => 'btn btn-success'))}}
            @else
                {{ Form::open(array('method' => 'POST', 'url' => 'usuariosTipos/'.$usuarioTipo->id.'/excluirConexao/'.$usuarioTipo->conexaoExterna->id)) }}
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Conexão Externa <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li> {{ link_to_action('ConexoesExternasController@getEditar', 'Editar Conexão',
                            ['idUsuarioTipo' => $usuarioTipo->id, 'id' => $usuarioTipo->conexaoExterna->id]) }}
                        </li>
                        <li>
                            <a data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Tipo de Usuário" data-message='Você tem certeza que deseja deletar essa conexão?'>
                                Deletar Conexão
                            </a>
                        </li>
                    </ul>
                </div>
                {{ Form::close() }}
            @endif

        </td>
        <td class="text-center">{{link_to_action('UsuariosTiposController@getEditar','Editar',['id'=>$usuarioTipo->id], ['class' => 'btn btn-primary'])}}</td>
        <td class="text-center">
            {{ Form::open(array('method' => 'POST', 'url' => 'usuariosTipos/excluir/'.$usuarioTipo->id, 'style' => 'display:inline;')) }}
            <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Tipo de Usuário" data-message='Você tem certeza que deseja deletar esse tipo de usuário?'>
                Deletar
            </button>

            {{ Form::close() }}
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="4">{{link_to_action('UsuariosTiposController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
    </tr>
</table>
{{$usuariosTipos->links()}}
@include('layouts.confirmarDelecao')
@endsection
