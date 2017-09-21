@extends('layouts.layout_admin')
@section('title', 'Tipos de Usuário')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Tipo de Usuário</h3>
        </div>
        <div class="panel-body">
            {{Form::model($usuarioTipo, array('url'=>route('usuariosTipos::atualizar', ['id' => $usuarioTipo->id])))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection