@extends('layouts.layout_admin')
@section('title', 'Locais')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                <ol class="breadcrumb">
                    <li>{{ link_to_route("unidades::index", "Unidade ".$local->unidade->nome) }}</li>
                    <li>Atualizar Local {{ $local->nome }}</li>
                </ol>
            </h3>
        </div>
        <div class="panel-body">
            {{Form::model($local, array('url'=>route('locais::atualizar', ['id' => $local->id])))}}
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