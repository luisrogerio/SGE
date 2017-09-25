@extends('layouts.layout_admin')
@section('title', 'Curso')
@section('content')
    <h1>Cursos</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($cursos as $curso)
            <tr>
                <td>{{$curso->nome}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'GET', 'url' => route('cursos::editar', ['id' => $curso->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-blue' type='submit'>
                        Editar
                    </button>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('cursos::excluir', ['id' => $curso->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Curso" data-message='Você tem certeza que deseja deletar esse curso?'>
                        <i class="fa fa-trash-o"></i>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                {{link_to_route('cursos::adicionar','Adicionar Novo', null, ['class' => 'button button-green'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$cursos->links()}}
    @include('layouts.confirmarDelecao')
@endsection