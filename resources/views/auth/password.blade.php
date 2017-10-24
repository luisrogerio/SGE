@extends('layouts.eventoPublico')
@section('title', 'Email Reset')
@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
            {{ Form::open(array('url' => route('auth::email'), 'class' => 'center-block formularioCadastro')) }}
            <h2 class="formularioCadastro-heading">Resetar Senha</h2>
            <fieldset>
                {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Email')) }}
            </fieldset>
            <div class="espacos"></div>
            <fieldset class="form-group">
                <button type="submit" class="button button-blue btn-block">
                    <span class="fa fa-refresh"></span> Resetar a Senha
                </button>
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>
@endsection