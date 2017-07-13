@extends('layouts.layout')
@section('title', 'Locais')
@section('content')

    <h1>
        <ol class="breadcrumb">
            <li>{{ link_to_route("unidades::index", "Unidade ".$unidade->nome) }}</li>
            <li>Locais</li>
        </ol>
    </h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">Nome</th>
            <th colspan="2" class="text-center">Opções</th>
            <th class="text-center" colspan="2">Salas</th>
        </tr>
        @foreach($locais as $local)
            <tr>
                <td class="text-center">{{$local->nome}}</td>
                <td class="text-center">{{link_to_route('locais::editar','Editar',['id'=>$local->id], ['class' => 'btn btn-primary'])}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('locais::excluir', ['id' => $local->id]), 'style' => 'display:inline;')) }}
                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Local" data-message='Você tem certeza que deseja deletar esse local?'>
                        Deletar
                    </button>

                    {{ Form::close() }}
                </td>
                <td>
                    {{Form::open(array('method' => 'GET', 'url' => route('salas::adicionar', ['idLocais' => $local->id]), 'class' => 'form-inline;')) }}
                    <fieldset class="form-group">
                        <div class="input-group">
                            {{Form::number('numeroDeSalas', null, array('class' => 'form-control', 'placeholder' => 'Número de Salas a Adicionar')) }}
                            <span class="input-group-btn">
                            {{Form::submit('Adicionar', array('class' => 'btn btn-primary'))}}
                        </span>
                        </div>
                    </fieldset>
                    {{Form::close()}}
                    @if ($errors->has('numeroDeSalas')) <p
                            class="help-block">{{ $errors->first('numeroDeSalas') }}</p> @endif
                </td>
                <td class="text-center">{{link_to_route('salas::index','Salas', ['idLocais'=>$local->id], ['class' => 'btn btn-default'])}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">{{ link_to_route('locais::adicionar','Adicionar Novo Local', ['idUnidades' => $unidade->id], ['class' => 'btn btn-primary'])}}</td>
        </tr>
    </table>
    {{$locais->links()}}
    @include('layouts.confirmarDelecao')
@endsection
