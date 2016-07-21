@extends('layouts.layout')
@section('title', 'Atividades')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'atividades/salvar'))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('', 'Cursos') }}
                <?php $i=0; ?>
                @foreach($cursos as $curso)
                    {{Form::checkbox('idCursos['.$i.']', $curso->id, false,
                        ['id' => 'idCursos['.$i.']'])}} {{Form::label('idCursos['.$i.']', $curso->sigla)}}<br>
                <?php $i++; ?>
                @endforeach
                @if ($errors->has('idCursos['.$i.']')) <p class="help-block">{{$errors->first('idCursos['.$i.']')}}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection