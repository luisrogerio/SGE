@extends('layouts.layout')
@section('title', 'Status de Atividade')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Status de Atividade</h3>
        </div>
        <div class="panel-body">
            {{Form::model($atividadeStatus, array('url'=>'statusdeatividade/atualizar/'.$atividadeStatus->id))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection