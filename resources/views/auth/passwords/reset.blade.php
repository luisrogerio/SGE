@extends('layouts.eventoPublico')
@section('title', 'Reset da Senha')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-3 col-lg-offset-3 col-md-10 col-lg-6">
            {{ Form::open(array('url' => route('auth::reset'), 'class' => 'center-block formularioCadastro')) }}
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
        </div>
    </div>
@endsection