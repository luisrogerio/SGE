@extends('layouts.layout_admin')
@section('title', 'Salas')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                <ol class="breadcrumb">
                    <li>{{ link_to_route("unidades::index", "Unidade ".$sala->local->unidade->nome) }}</li>
                    <li>{{ link_to_route("locais::index", "Local ".$sala->local->nome, ['id' => $sala->local->unidade->id]) }}</li>
                    <li>Atualizar Sala {{ $sala->nome }}</li>
                </ol>
            </h3>
        </div>
        <div class="panel-body">
            {{Form::model($sala, array('url'=>route('salas::atualizar', ['id' => $sala->id])))}}
            <fieldset class="form-group">
                {{Form::label('tipoDeEspaco', 'Tipo de Espaço')}}
                {{ Form::select('tipoDeEspaco', $tiposDeEspaco, $sala->tipoDeEspaco->id, array('class' => 'form-control')) }}
                @if ($errors->has('tipoDeEspaco')) <p class="help-block">{{ $errors->first('tipoDeEspaco') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('quantidade_ocupacao', 'Vagas de Ocupação')}}
                {{Form::number('quantidade_ocupacao', null, array('class' => 'form-control col-xs-2 hack-espaco'))}}
                @if ($errors->has('quantidade_ocupacao')) <p
                        class="help-block">{{ $errors->first('quantidade_ocupacao') }}</p> @endif
            </fieldset>

            <br/>
            {{Form::submit('Editar', array('class' => 'button button-blue'))}}
            {{link_to_route('salas::index','Voltar', ['idLocais' => $sala->local->id], ['class' => 'button button-green'])}}
            <button class="button button-green">
                {{link_to_route('salas::index','Voltar', ['idLocais' => $sala->local->id], ['style' => 'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
@endsection