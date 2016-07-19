@extends('layouts.layout')
@section('title', 'Locais')
@section('content')

<h1>Locais</h1>
<table class="table table-striped table-bordered">
    <tr><th>Nome</th><th colspan="2" class="text-center">Opções</th></tr>
@foreach($locais as $local)
    <tr>
        <td>{{$local->nome}}</td>
        <td class="text-center">{{link_to_action('LocaisController@getEditar','Editar',['id'=>$local->id], ['class' => 'btn btn-primary'])}}</td>
        <td class="text-center">
            {{ Form::open(array('method' => 'POST', 'url' => 'locais/excluir/'.$local->id, 'style' => 'display:inline;')) }}
            <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Local" data-message='Você tem certeza que deseja deletar esse local?'>
                Deletar
            </button>

            {{ Form::close() }}
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="3">{{link_to_action('LocaisController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
    </tr>
</table>
{{$locais->links()}}
@include('layouts.confirmarDelecao')
@endsection
