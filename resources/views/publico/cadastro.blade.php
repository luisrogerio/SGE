@extends('layouts.eventoLayout')
@section('title', "- Cadastro")
@section('content')
    <div class="row">
        <div class="conteiner">
            <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                <h1 class="text-center">Cadastro de Usuários</h1>
                <p class="paragrafo">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <ul class="nav nav-tabs">
                    <div class="espacos"></div>
                    <li class="active">
                        <a data-toggle="tab" href="#alunos">
                            <h4>Alunos</h4>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#professores">
                            <h4>Servidores</h4>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#servidores">
                            <h4>Visitantes</h4>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="alunos" class="tab-pane fade in active">
                        {{ Form::open(array('url' => '/cadastroAluno', 'class' => 'form-inline text-center')) }}
                        <h3>Cadastro de Alunos</h3>
                        <label>
                            Matrícula: {{ Form::text('matricula', null, array('placeholder' => 'Matrícula')) }}
                        </label>
                        <label>
                            CPF do
                            Aluno: {{ Form::text('cpfAluno', null,array('placeholder' => 'CPF', 'id' => 'cpfAluno')) }}
                        </label>
                        {{ Form::submit('Cadastrar', ['class' => 'button button-blue']) }}
                        {{ Form::close() }}
                    </div>
                    <div id="professores" class="tab-pane fade">
                        {{ Form::open(array('url' => '/cadastroServidor', 'class' => 'form-inline text-center')) }}
                        <h3>Cadstro de Servidores</h3>
                        <label>
                            SIAPE: {{ Form::text('matricula', null, array('placeholder' => 'Matrícula')) }}
                        </label>
                        <label>
                            CPF do Servidor: {{ Form::text('cpfServidor', null, array('placeholder' => 'CPF')) }}
                        </label>
                        {{ Form::submit('Cadastrar', array('class' => 'button button-blue')) }}
                        {{ Form::close() }}
                    </div>
                    <div id="servidores" class="tab-pane fade">
                        {{ Form::open(array('url' => '/cadastroExterno', 'class' => 'form-inline text-center')) }}
                            <h3>Visitantes</h3>
                            <label>
                                Nome: {{ Form::text('nome', null, array('placeholder' => 'Nome Completo')) }}
                            </label>
                            <label>
                                CPF do
                                Visitante: {{ Form::text('cpfExterno', null, array('placeholder' => 'CPF', $errors->cpfExterno? 'autofocus':'', 'id' => 'cpfExterno')) }}
                            </label>
                        {{ Form::submit('Cadastrar', array('class' => 'button button-blue')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#cpfAluno").mask('000.000.000-00');
            $("#cpfExterno").mask('000.000.000-00');
        });
    </script>
@endsection