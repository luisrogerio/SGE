@extends('layouts.layout_admin')
@section('title', 'Contatos')
@section('content')
    <h2>Contatos</h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($eventosContatos as $eventoContato)
            <tr>
                <td>{{$eventoContato->nome}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'GET', 'url' => route('contatos::editar', ['id'=>$eventoContato->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-blue' type='submit'>
                        Editar
                    </button>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('contatos::excluir', ['id'=>$eventoContato->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Contato"
                            data-message='Você tem certeza que deseja deletar esse contato?'>
                        <i class="fa fa-trash-o"></i>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                {{link_to_route('contatos::adicionar','Adicionar Novo', null, ['class' => 'button button-green'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$eventosContatos->links()}}
    @include('layouts.confirmarDelecao')
@endsection