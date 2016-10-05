@extends('layouts.layout')
@section('title', 'Conexão Externa com Banco')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Nova</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'usuariosTipos/'.$usuarioTipo->id.'/salvarConexao'))}}
            <fieldset class="form-group">
                {{Form::label('driver', 'Driver de Conexão')}}
                {{Form::select('driver', array('mysql' => 'MySQL', 'pgsql' => 'Postgres SQL', 'sqlite' => 'SQLite'), null, array('class' => 'form-control'))}}
                @if ($errors->has('driver')) <p class="help-block">{{ $errors->first('driver') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('host', 'Host de Conexão')}}
                {{Form::text('host', null, array('class' => 'form-control', 'placeholder' => 'dominio.example.com:porta'))}}
                @if ($errors->has('host')) <p class="help-block">{{ $errors->first('host') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('database', 'Database de Conexão')}}
                {{Form::text('database', null, array('class' => 'form-control', 'placeholder' => 'Nome da Base de Dados'))}}
                @if ($errors->has('database')) <p class="help-block">{{ $errors->first('database') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('view', 'Nome da View')}}
                {{Form::text('view', null, array('class' => 'form-control', 'placeholder' => 'Nome da View'))}}
                @if ($errors->has('view')) <p class="help-block">{{ $errors->first('view') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('login', 'Login da Conexão')}}
                {{Form::text('login', null, array('class' => 'form-control'))}}
                @if ($errors->has('login')) <p class="help-block">{{ $errors->first('login') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('senha', 'Senha da Conexão')}}
                {{Form::password('senha', array('class' => 'form-control'))}}
                @if ($errors->has('senha')) <p class="help-block">{{ $errors->first('senha') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection