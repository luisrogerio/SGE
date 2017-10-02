@extends('layouts.layout_admin')
@section('title', 'Tipos de Usuário')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>route('usuariosTipos::salvar')))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <button class='button button-green'>
                {{link_to_route('usuariosTipos::index','Voltar', null, ['style' => 'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
@endsection