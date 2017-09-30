@extends('layouts.layout_admin') @section('title', 'Atividade') @section('content')
<h1>Atividade</h1>
<table class="table table-striped table-bordered">
    <tr>
        <th>Nome</th>
        <th colspan="2" class="text-center">Opções</th>
    </tr>
    @foreach($atividades as $atividade)
    <tr>
        <td>{{$atividade->nome}}</td>
        <td class="text-center">
            {{ Form::open(array('method' => 'GET', 'url' => route('atividades::view', ['id' => $atividade->id]), 'style' => 'display:inline;'))
            }}
            <button class='button button-blue' type='submit'>
                        Visualizar
                    </button> {{ Form::close() }}
        </td>
        <td class="text-center">
            {{ Form::open(array('method' => 'POST', 'url' => route('atividades::excluir', ['id' => $atividade->id]), 'style' => 'display:inline;'))
            }}
            <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete" data-title="Deletar Atividade"
                data-message='Você tem certeza que deseja deletar essa atividade?'>
                        <i class="fa fa-trash-o"></i>
                        Deletar
                    </button> {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3">
            <div class="btn-group">
                {{link_to_route('atividades::adicionar','Adicionar Novo', ['id' => $evento->id], ['class' => 'button button-green'])}} {{
                link_to_route('eventos::visualizar', "Voltar" ,['id' => $evento->id], ['class' => 'button button-blue'])
                }}
                <button class="button button-green">
                    {{link_to_route('eventos::visualizar', "Voltar" ,['id' => $evento->id], ['style' => 'color:#fff;'])}}
                </button>
            </div>
        </td>
    </tr>
</table>
{{$atividades->links()}} @include('layouts.confirmarDelecao') @endsection