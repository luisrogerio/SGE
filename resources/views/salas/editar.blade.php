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
                {{Form::label('prefixo', 'Prefixo')}}
                {{ Form::select('prefixo', array(
                    'Sala' => 'Sala',
                    'Laboratório' => 'Laboratório',
                    'Anfiteatro' => 'Anfiteatro',
                    'Galpão' => 'Galpão',
                    'Quadra' => 'Quadra',
                    'Salão' => 'Salão'
                    ), null, array('class' => 'form-control')) }}
                @if ($errors->has('prefixo')) <p class="help-block">{{ $errors->first('prefixo') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('sufixo', 'Nome')}}
                {{Form::text('sufixo', null, array('class' => 'form-control'))}}
                @if ($errors->has('sufixo')) <p class="help-block">{{ $errors->first('sufixo') }}</p> @endif
            </fieldset>

            <br/>
            {{Form::submit('Editar', array('class' => 'button button-blue'))}}
            {{link_to_route('salas::index','Voltar', ['idLocais' => $sala->local->id], ['class' => 'button button-green'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection