@extends('layouts.layout_admin')
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
                <td>
                    <h3>{{$unidade->nome}}</h3>
                </td>
                <td class="text-center">
                    <div class="espacos"></div>
                    {{link_to_route('unidades::editar','Editar',['id'=>$unidade->id], ['class' => 'button button-blue'])}}
                </td>
                <td class="text-center">
                    <div class="espacos"></div>
                    {{ Form::open(array('method' => 'POST', 'url' => route('unidades::excluir', ['id' => $unidade->id]), 'style' => 'display:inline;')) }}
                    <a class="button button-link" type='button' data-toggle="modal" data-target="#confirmDelete"
                       data-title="Deletar Unidade" data-message='Você tem certeza que deseja deletar esse unidade?'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Deletar
                    </a>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    <div class="espacos"></div>
                    {{ link_to_route('locais::index','Ambientes', ['unidadeId' => $unidade->id], ['class' => 'button button-orange']) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                {{ link_to_route('unidades::adicionar','Adicionar Novo', null, ['class' => 'button button-green'])}}
                {{link_to_route('admin::index','Voltar', null, ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>

    {{$unidades->links()}}
    @include('layouts.confirmarDelecao')
@endsection
