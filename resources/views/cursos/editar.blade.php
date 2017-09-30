@extends('layouts.layout_admin')
@section('title', 'Cursos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Curso</h3>
        </div>
        <div class="panel-body">
            {{Form::model($curso, array('url'=>route('cursos::atualizar', ['id' => $curso->id])))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('sigla', 'Sigla') }}
                {{Form::text('sigla', null, array('class' => 'form-control', 'maxlength' => 10))}}
                @if ($errors->has('sigla')) <p class="help-block">{{$errors->first('sigla')}}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <button class='button button-green'>
                {{link_to_route('cursos::index','Voltar', null, ['style'=>'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
@endsection