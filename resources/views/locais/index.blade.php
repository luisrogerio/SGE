@extends('layouts.layout_admin')
@section('title', 'Locais')
@section('content')

    <h2>
        <ol class="breadcrumb">
            <li>{{ link_to_route("unidades::index", "Unidade ".$unidade->nome) }}</li>
            <li>Locais</li>
        </ol>
    </h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">Nome</th>
            <th colspan="2" class="text-center">Opções</th>
            <th class="text-center" colspan="2">Salas</th>
        </tr>
        @foreach($locais as $local)
            <tr>
                <td class="text-center">{{$local->nome}}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'GET', 'url' => route('locais::editar', ['id' => $local->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-blue' type='submit'>
                        Editar
                    </button>
                    {{ Form::close() }}
                </td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'POST', 'url' => route('locais::excluir', ['id' => $local->id]), 'style' => 'display:inline;')) }}
                    <button class='button button-link' type='button' data-toggle="modal" data-target="#confirmDelete"
                            data-title="Deletar Local" data-message='Você tem certeza que deseja deletar esse local?'>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Deletar
                    </button>
                    {{ Form::close() }}
                </td>
                <td>
                    {{Form::open(array('method' => 'GET', 'url' => route('salas::adicionar', ['idLocais' => $local->id]), 'class' => 'form-inline;')) }}
                    <fieldset class="form-group">
                        <div class="input-group">
                            {{Form::number('numeroDeSalas', null, array('class' => 'form-control', 'placeholder' => 'Número de Salas a Adicionar')) }}
                            <span class="input-group-addon">
                                <button type="submit" class="button-link">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </fieldset>
                    {{Form::close()}}
                    @if ($errors->has('numeroDeSalas')) <p
                            class="help-block">{{ $errors->first('numeroDeSalas') }}</p> @endif
                </td>
                <td class="text-center">{{link_to_route('salas::index','Salas', ['idLocais'=>$local->id], ['class' => 'button button-orange'])}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">
                {{ link_to_route('locais::adicionar','Adicionar Novo Local', ['idUnidades' => $unidade->id], ['class' => 'button button-green'])}}
            </td>
        </tr>
    </table>
    {{$locais->links()}}
    @include('layouts.confirmarDelecao')
@endsection
