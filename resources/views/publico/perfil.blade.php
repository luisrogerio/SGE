@extends('layouts.eventoPublico')
@section('title', 'Perfil')
@section('content')
    <div class="espacos"></div>
    @if(Session::has('status'))
        @if (Session::get('status') == 200)
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Sua senha foi alterada com sucesso
            </div>
        @else
            @if(Session::get('status') == 400)

                <div class="alert alert-warning fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Senha fornecida não válida
                </div>
            @endif
        @endif
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Configurações Gerais da Conta - Perfil</h2>
                </div>
                <div class="panel-body">
                    <p class="text-justify">
                        Bem-vindo {{ Auth::user()->nome }}. Confira suas informações abaixo e clique para alterá-las
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item">Nome: {{ Auth::user()->nome }}</li>
                        <li class="list-group-item">E-mail de contato: {{ Auth::user()->email }}</li>
                        <li class="list-group-item">Data de
                            Nascimento: {{ Auth::user()->dataNascimento->formatLocalized('%d de %B de %G') }}</li>
                    </ul>
                    {{ Form::open(['url' => route('auth::passwordChange')])}}
                    <div class="form-group">
                        {{ Form::label('password', 'Senha Atual') }}
                        {{ Form::password('password', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('newPassword', 'Nova Senha (8 a 20 caracteres)', [
                                'data-toggle' => "tooltip",
                                'title' => "A senha poderá conter caracteres alfanuméricos, traços e sublinhados"]) }}
                        {{ Form::password('newPassword', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('newPassword_confirmation', 'Confirmar Nova Senha') }}
                        {{ Form::password('newPassword_confirmation', ['class' => 'form-control']) }}
                    </div>
                    {{ Form::hidden('email', Auth::user()->email) }}
                    {{ Form::submit('Redefinir senha', ['class' => 'button button-green']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
