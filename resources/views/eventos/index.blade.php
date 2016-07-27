@extends('layouts.layout')
@section('title', 'Evento')
@section('content')
    <h1>Eventos</h1>
    <table class="table">
        @foreach($eventos as $evento)
            <tr>
                <td>
                    <img src="/imagens/3.png" class="img-thumbnail img-circle" >
                </td>
                <td>
                    <h3 id="nomeEvento">
                        {{$evento->nome}}
                    </h3>
                    <div id="descricaoEvento">
                        <p>{!! $evento->descricao !!}</p>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_action('EventosController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$eventos->links()}}
@endsection