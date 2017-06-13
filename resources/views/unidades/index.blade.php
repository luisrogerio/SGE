@extends('layouts.layout')
@section('title', 'Unidades')
@section('content')

    <h1>Unidades</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">Nome</th>
            <th colspan="2" class="text-center">Opções</th>
            <th class="text-center">Locais</th>
        </tr>
        @foreach($unidades as $unidade)
            <tr>
                <td>{{$unidade->nome}}</td>
                <td class="text-center">{{link_to_route('unidades::editar','Editar',['id'=>$unidade->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'unidades/excluir/'.$unidade->id, 'style' => 'display:inline;')) }}
                    <a class="btn btn-link" type='button' data-toggle="modal" data-target="#confirmDelete"
                       data-title="Deletar Unidade" data-message='Você tem certeza que deseja deletar esse unidade?'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Deletar
                    </a>

                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ link_to_route('locais::index','<i class="fa fa-picture-o" aria-hidden="true"></i>Locais', ['unidadeId' => $unidade->id], ['class' => 'btn btn-link'])}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">{{ link_to_route('unidades::adicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$unidades->links()}}
    @include('layouts.confirmarDelecao')
@endsection
