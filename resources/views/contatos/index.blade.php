@extends('layouts.layout')
@section('title', 'Contatos')
@section('content')
    <h1>Contatos</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($eventosContatos as $eventoContato)
            <tr>
                <td>{{$eventoContato->nome}}</td>
                <td class="text-center">{{link_to_route('contatos::editar','Editar',['id'=>$eventoContato->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'contatos/excluir/'.$eventoContato->id, 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Contato"
                            data-message='Você tem certeza que deseja deletar esse contato?'>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_route('contatos::adicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$eventosContatos->links()}}
    @include('layouts.confirmarDelecao')
@endsection