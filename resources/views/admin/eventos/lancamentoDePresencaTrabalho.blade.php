@extends('layouts.layout_admin')
@section('title', 'Trabalho')
@section('content')
    <h1>Lançamento de Presença dos Autores/Apresentadores</h1>
    <div class="espacos"></div>
    {{ Form::open(['url' => route('eventos::lancarPresencaTrabalhos', ['id' => $id])]) }}
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome do Autor/Apresentador</th>
            <th>Nome do Trabalho</th>
            <th class="text-center">Presença</th>
            <th>Tipo de Apresentação</th>
        </tr>
        @foreach ($trabalhos as $trabalho)
            <?php $idEvento = $trabalho->evento_id; ?>
            <tr>
                <td class="text-uppercase">{{$trabalho->nomePessoa}}</td>
                <td class="text-uppercase">{{$trabalho->tituloTrabalho}}</td>
                <td class="text-center">
                    {{ Form::checkbox('presenca['.$trabalho->id.']', $trabalho->id, $trabalho->presenca, ['class' => 'input-group']) }}
                </td>
                <td class="text-center">
                    {{ Form::select('apresentacao['.$trabalho->id.']',
                                [   0 => 'Sem Apresentação',
                                    1 => 'Apresentação Banner',
                                    2 => 'Apresentação Oral'],
                                    $trabalho->apresentacao,
                                    ['class' => 'form-control']) }}
                </td>
            </tr>
        @endforeach
    </table>
    <label for="classificacao">Premiação do Trabalho</label>
    {{ Form::select('classificacao',
                                [   null => 'Sem Colocação',
                                    1 => '1° Lugar',
                                    2 => '2° Lugar',
                                    3 => '3° Lugar'],
                                    $trabalho->classificacao,
                                    ['class' => 'form-control']) }}
    <br/>
    <div class="btn-group">
        {{ Form::submit('Lançar Presenças', ['class' => 'button button-blue']) }}
        <a href="{{ route('eventos::lancamentoDePresencaTrabalhos',['id' => $idEvento], ['style' => 'color:#fff;']) }}">
            <button type="button" class="button button-green">
                Voltar
            </button>
        </a>
        <div class="espacos"></div>
    </div>
    {{ Form::close() }}
@endsection