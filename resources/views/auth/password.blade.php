@extends('layouts.layoutPublico')
@section('title', 'Email Reset')
@section('content')
    {{ Form::open(array('url' => 'email', 'class' => 'center-block formularioCadastro')) }}
    <h2 class="formularioCadastro-heading">Resetar Senha</h2>
    <fieldset>
        {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Email')) }}
    </fieldset>
    <fieldset class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block">
            <span class="fa fa-refresh"></span> Resete a Senha
        </button>
    </fieldset>
    {{ Form::close() }}
@endsection