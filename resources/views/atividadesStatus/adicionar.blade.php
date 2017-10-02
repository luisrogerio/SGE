@extends('layouts.layout_admin')
@section('title', 'Status de Atividade')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>route('statusdeatividade::salvar')))}}
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            {{link_to_route('statusdeatividade::index','Voltar', null, ['class' => 'button button-green'])}}
            <button class='button button-green'>
                {{link_to_route('statusdeatividade::index','Voltar', null, ['style'=>'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
@endsection