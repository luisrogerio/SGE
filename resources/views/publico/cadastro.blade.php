@extends('layouts.layoutPublico')
@section('scriptsExtras')
    {{Html::script('js/jquery.mask.js')}}
@endsection
@section('title', 'Login')
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
        <div class="col-xs-12 col-md-4">
            {{ Form::open(array('url' => '/cadastroAluno', 'class' => 'center-block formularioCadastro')) }}
            <h2 class="formularioCadastro-heading">Cadastro Aluno</h2>
            <fieldset>
                {{ Form::text('matricula', null, array('class' => 'form-control input-lg', 'placeholder' => 'Matrícula')) }}
            </fieldset>
            <fieldset>
                {{ Form::text('cpfAluno', null,array('class' => 'form-control input-lg', 'placeholder' => 'CPF')) }}
            </fieldset>
            </fieldset>
            <fieldset>
                {{ Form::submit('Cadastre-se', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            </fieldset>
            {{ Form::close() }}
        </div>
        <div class="col-xs-12 col-md-4">
            {{ Form::open(array('url' => '/cadastroServidor', 'class' => 'center-block formularioCadastro')) }}
            <h2 class="formularioCadastro-heading">Cadastro Servidor</h2>
            <fieldset>
                {{ Form::text('matricula', null, array('class' => 'form-control input-lg', 'placeholder' => 'Matrícula')) }}
            </fieldset>
            <fieldset>
                {{ Form::text('cpfServidor', null, array('class' => 'form-control input-lg', 'placeholder' => 'CPF')) }}
            </fieldset>
            </fieldset>
            <fieldset>
                {{ Form::submit('Cadastre-se', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            </fieldset>
            {{ Form::close() }}
        </div>
        <div class="col-xs-12 col-md-4">
            {{ Form::open(array('url' => '/cadastroExterno', 'class' => 'center-block formularioCadastro')) }}
            <h2 class="formularioCadastro-heading">Cadastro Externo</h2>
            <fieldset class="{{ $errors->has('cpfExterno')? 'has-error':'' }}">
                {{ Form::text('cpfExterno', null, array('class' => 'form-control input-lg', 'placeholder' => 'CPF',
                    $errors->cpfExterno? 'autofocus':'', 'id' => 'cpfExterno')) }}
            </fieldset>
            <fieldset class="{{ $errors->has('nome')? 'has-error':'' }}">
                {{ Form::text('nome', null,array('class' => 'form-control input-lg', 'placeholder' => 'Nome Completo')) }}
            </fieldset>
            </fieldset>
            <fieldset>
                {{ Form::submit('Cadastre-se', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            </fieldset>
            {{ Form::close() }}
        </div>
    </div>
    <script type="text/javascript">
        $(function (){
            $("#cpfExterno").mask('000.000.000-00');
        });
    </script>
@endsection