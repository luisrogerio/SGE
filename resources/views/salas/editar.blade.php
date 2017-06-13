@extends('layouts.layout')
@section('title', 'Salas')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Unidade {{ $sala->local->unidade->nome }} - Local {{ $sala->local->nome }} - Atualizar Sala</h3>
        </div>
        <div class="panel-body">
            {{Form::model($sala, array('url'=>'salas/atualizar/'.$sala->id))}}
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

            <br />
            {{Form::submit('Editar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection