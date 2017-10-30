@extends('layouts.eventoPublico')
@section('title', 'Email Reset')
@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            E-mail enviado com sucesso. Favor verificar sua caixa de mensagens
        </div>
    @endif
    <div class="row">
        <div class="col-md-offset-3 col-lg-offset-3 col-md-6 col-lg-6">
            {{ Form::open(array('url' => route('auth::email'), 'class' => 'center-block formularioCadastro')) }}
            <h2 class="formularioCadastro-heading">Resetar Senha</h2>
            @if($errors->has())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <fieldset>
                {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Email')) }}
            </fieldset>
            <div class="espacos"></div>
            <fieldset class="form-group">
                <button type="submit" class="button button-blue btn-block">
                    <span class="fa fa-refresh"></span> Redefinir Senha
                </button>
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>
@endsection