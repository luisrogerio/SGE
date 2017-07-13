@extends('layouts.layout')
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
                <td class="text-center">{{link_to_route('cursos::editar','Editar',['id'=>$curso->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('cursos::excluir', ['id' => $curso->id]), 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Curso" data-message='Você tem certeza que deseja deletar esse curso?'>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_route('cursos::adicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$cursos->links()}}
    @include('layouts.confirmarDelecao')
@endsection