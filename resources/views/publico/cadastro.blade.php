@extends('layouts.layoutPublico')
@section('title', "- Cadastro")
@section('content')
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="espacos"></div>
            <h2>Preencha o formulário com seus dados</h2>
            <h4>
                Seus dados são necessários para o cadastro no sistema.
            </h4>
            <div class="espacos"></div>
            {{Form::open(array('url' => route('auth::salvar')))}}
            <fieldset class="form-group">
                {{ Form::label('nome', 'Nome') }}
                {{ Form::text('nome', null, array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('email', 'E-mail') }}
                {{ Form::email('email', null, array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('confirmarEmail', 'Confirmar E-mail') }}
                {{ Form::email('confirmarEmail', null, array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('dataDeNascimento', 'Data de Nascimento') }}
                {{ Form::text('dataNascimento', null, array('class' => 'form-control', 'id' => 'dataDeNascimento', 'maxlength' => '10')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('senha', 'Senha') }}
                {{ Form::password('senha', array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('confirmarSenha', 'Confirmar Senha') }}
                {{ Form::password('confirmarSenha', array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                <button type="submit" class="button button-blue center-block pull-right">Cadastrar</button>
            </fieldset>
            {{Form::close() }}
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#dataDeNascimento').mask('##/##/####');
        });
    </script>
@endsection