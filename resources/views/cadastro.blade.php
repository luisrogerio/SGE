@extends('layouts.new_layout')
@section('title', "- Cadastro")
@section('content')
    <div class="row">
        <div class="conteiner">
            <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                <h1 class="text-center">Cadastro de Usuários</h1>
                <p class="paragrafo">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
                            <h4>Professores</h4>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#servidores">
                            <h4>Servidores</h4>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="alunos" class="tab-pane fade in active">

                        <form class="form-inline text-center">
                            <h3>Cadastro de Alunos</h3>
                            <label>
                                Número de Matrícula: <input type="text" class="form-input" />
                            </label>
                            <label>
                                Senha: <input type="password" class="form-input" />
                            </label>
                            <label>
                                <input type="checkbox" class="form-input" />
                                Manter Conectado?
                            </label>
                            <input type="submit" class="btn btn-primary" value="Cadastrar" />
                        </form>
                    </div>
                    <div id="professores" class="tab-pane fade">

                        <form class="form-inline text-center">
                            <h3>Professores</h3>
                            <label>
                                Número de Matrícula: <input type="text" class="form-input" />
                            </label>
                            <label>
                                Senha: <input type="password" class="form-input" />
                            </label>
                            <label>
                                <input type="checkbox" class="form-input" />
                                Manter Conectado?
                            </label>
                            <input type="submit" class="btn btn-primary" value="Cadastrar" />
                        </form>
                    </div>
                    <div id="servidores" class="tab-pane fade">
                        <form class="form-inline text-center">
                            <h3>Servidores</h3>
                            <label>
                                Número de Matrícula: <input type="text" class="form-input" />
                            </label>
                            <label>
                                Senha: <input type="password" class="form-input" />
                            </label>
                            <label>
                                <input type="checkbox" class="form-input" />
                                Manter Conectado?
                            </label>
                            <input type="submit" class="btn btn-primary" value="Cadastrar" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection