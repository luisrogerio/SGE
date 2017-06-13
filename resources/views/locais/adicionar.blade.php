@extends('layouts.layout')
@section('title', 'Locais')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo Local - Unidade {{ $unidade->nome }}</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'locais/salvar'))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif

                {{Form::hidden('idUnidades', $unidade->id)}}
                @if ($errors->has('idUnidades')) <p class="help-block">{{ $errors->first('idUnidades') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection