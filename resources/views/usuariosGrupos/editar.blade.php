@extends('layouts.layout')
@section('title', 'usuariosGrupos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Grupo de Usuário</h3>
        </div>
        <div class="panel-body">
            {{Form::model($usuarioGrupo, array('url'=>'gruposdeusuario/atualizar/'.$usuarioGrupo->id))}}
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