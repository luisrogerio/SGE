@extends('layouts.layout')
@section('title', 'Evento')
@section('content')
    <h1>Evento</h1>
    <table class="table" >
        @foreach($eventos as $evento)
            <tr>
                <td><img src="/imagens/1.png" class="img-thumbnail img-circle" ></td>
                <td>{{$evento->nome}}</td>
                <td class="text-center"></td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'eventos/excluir/'.$evento->id, 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Evento" data-message='Você tem certeza que deseja deletar o evento?'>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_action('EventosController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$eventos->links()}}
    @include('layouts.confirmarDelecao')
@endsection