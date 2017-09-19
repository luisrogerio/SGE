@extends('layouts.layoutPublico')
@section('title', 'Reset da Senha')
@section('content')

    <div class="espacos"></div>
    <div class="espacos"></div>
    <div class="espacos"></div>

    {{ Form::open(array('url' => '/password/reset', 'class' => 'center-block formularioCadastro')) }}
    <h2 class="formularioCadastro-heading">Resetar Senha</h2>
    <fieldset>
        {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Email')) }}
    </fieldset>
    <fieldset>
        {{ Form::password('password', array('class' => 'form-control input-lg', 'placeholder' => 'Senha', 'style' => 'margin-bottom: 0px;')) }}
    </fieldset>
    <fieldset>
        {{ Form::password('password_confirmation', array('class' => 'form-control input-lg', 'placeholder' => 'Confirmar Senha')) }}
    </fieldset>
    <fieldset>
        {{ Form::submit('Resete a Senha', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    </fieldset>
    {{ Form::close() }}
@endsection