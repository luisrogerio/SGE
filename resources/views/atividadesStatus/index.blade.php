@extends('layouts.layout')
@section('title', 'Status de Atividade')
@section('content')

    <h1>Status de Atividade</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($atividadesStatus as $atividadeStatus)
            <tr>
                <td>{{$atividadeStatus->nome}}</td>
                <td class="text-center">{{link_to_route('statusdeatividade::editar','Editar',['id'=>$atividadeStatus->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => 'statusdeatividade/excluir/'.$atividadeStatus->id, 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Status da Atividade"
                            data-message='Você tem certeza que deseja deletar esse status de atividade?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">{{link_to_route('statusdeatividade::adicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$atividadesStatus->links()}}
    @include('layouts.confirmarDelecao')
@endsection
