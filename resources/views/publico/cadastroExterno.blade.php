@extends('layouts.layoutPublico')
@section('cssExtras')
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection
@section('scriptsExtras')
    {{ Html::script('js/moment.js') }}
    {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
@endsection
@section('title', 'Cadastro Externo')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <h3>Preencha o restante do formulário com seus dados</h3>
            {{Form::open(array('url' => '/salvarExterno'))}}
            <fieldset class="form-group">
                {{ Form::label('nome', 'Nome') }}
                {{ Form::text('nome', $nome, array('class' => 'form-control', 'readonly')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('email', 'E-mail') }}
                {{ Form::email('email', null, array('class' => 'form-control')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('dataNascimento', 'Data de Nascimento') }}
                {{ Form::text('dataNascimento', null, array('class' => 'form-control', 'id' => 'dataDeNascimento')) }}
            </fieldset>
            <fieldset class="form-group">
                {{ Form::label('cpf', 'CPF') }}
                {{ Form::text('cpf', $cpf, array('class' => 'form-control', 'readonly')) }}
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
                <button type="submit" class="btn btn-primary btn-large center-block">Cadastrar</button>
            </fieldset>
            {{Form::close() }}
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#dataDeNascimento').datetimepicker({
                locale: 'pt-br',
                format: 'DD/MM/YYYY',
                viewMode: 'years'
            });
        });
    </script>
@endsection