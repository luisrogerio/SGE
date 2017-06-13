@extends('layouts.layoutPublico')
@section('title', 'Login')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(array('url' => '/login', 'class' => 'center-block formularioCadastro')) }}
    <h2 class="formularioCadastro-heading">Por favor logue-se</h2>
    <fieldset>
        {{ Form::text('login', null, array('class' => 'form-control input-lg', 'placeholder' => 'Login')) }}
    </fieldset>
    <fieldset>
        {{ Form::password('senha', array('class' => 'form-control input-lg', 'placeholder' => 'Senha')) }}
    </fieldset>
    <fieldset class="checkbox">
        <label>
            {{ Form::checkbox('remember', true, null) }} Continuar conectado
        </label>
    </fieldset>
    <fieldset>
        {{ link_to('/reset', 'Esqueceu sua senha?') }}
        {{ Form::submit('Entrar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    </fieldset>
    {{ Form::close() }}
@endsection