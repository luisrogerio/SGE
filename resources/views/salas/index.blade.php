@extends('layouts.layout_admin')
@section('title', 'Salas')
@section('content')

    <h2>
        <ol class="breadcrumb">
            <li>{{ link_to_route("unidades::index", "Unidade ".$local->unidade->nome) }}</li>
            <li>{{ link_to_route("locais::index", "Local ".$local->nome, ['id' => $local->unidade->id]) }}</li>
            <li>Salas</li>
        </ol>
    </h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($salas as $sala)
            <tr>
                <td>{{$sala->nome}}</td>
                <td class="text-center">{{link_to_route('salas::editar','Editar',['id'=>$sala->id], ['class' => 'button button-blue'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('salas::excluir', ['id' => $sala->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Sala" data-message='Você tem certeza que deseja deletar essa sala?'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{ link_to_route('salas::adicionar','Adicionar Novo', ['idLocais' => $local->id], ['class' => 'button button-green'])}}</td>
        </tr>
    </table>
    {{$salas->links()}}
    @include('layouts.confirmarDelecao')

    <div class="espacos"></div>
    <div class="espacos"></div>
    <div class="espacos"></div>
@endsection
