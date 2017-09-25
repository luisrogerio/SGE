@extends('layouts.layout_admin'))
@section('title', 'Notícias do Evento')
@section('content')
    <h1>Notícias</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Título</th>
            <th>Preview</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($eventosNoticias as $eventoNoticia)
            <tr>
                <td>{{$eventoNoticia->titulo}}</td>
                <td>{{$eventoNoticia->preview}} [...]</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'GET', 'url' => route('eventosNoticias::editar', ['id' => $eventoNoticia->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-blue' type='submit'>
                        Editar
                    </button>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('eventosNoticias::excluir', ['id' => $eventoNoticia->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Notícia"
                            data-message='Você tem certeza que deseja deletar essa notícia?'>
                        <i class="fa fa-trash-o"></i>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                {{link_to_route('eventosNoticias::adicionar','Adicionar Nova', ['idEventos' => $evento->id], ['class' => 'button button-green'])}}
                {{link_to_route('eventos::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$eventosNoticias->links()}}
    @include('layouts.confirmarDelecao')
@endsection