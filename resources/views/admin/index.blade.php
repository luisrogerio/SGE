@extends('layouts.layout_admin')
@section('title', 'Administrador')
@section('content')
    <h2 class="text-center"><i class="fa fa-hashtag" aria-hidden="true"></i> Área Administrativa</h2>
    <h4 class="text-center">Bem-vindo a área destinada aos administradores</h4>
    <div class="espacos"></div>
    <div class="row row-grid">
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('eventos::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Eventos
                </a>
            </h3>
            <p class="title-desc">
                Cadastre os novos eventos no link abaixo
            </p>
            <a href="{{ route('eventos::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Novo Evento
            </a>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('contatos::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Contatos de Evento
                </a>
            </h3>
            <p class="title-desc">
                Cadastre os contatos disponíveis para os eventos no link abaixo
            </p>
            <a href="{{ route('contatos::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Novo Contato
            </a>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('espacosTipos::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Tipos de Espaço
                </a>
            </h3>
            <p class="title-desc">
                Cadastre os novos tipos de espaço no link abaixo
            </p>
            <a href="{{ route('espacosTipos::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Novo Tipo de Espaço
            </a>
        </div>
    </div>
    <div class="row row-grid">
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('unidades::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Unidades
                </a>
            </h3>
            <p class="title-desc">
                Cadastre as novas unidades no link abaixo
            </p>
            <a href="{{ route('unidades::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Nova Unidade
            </a>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('cursos::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Cursos
                </a>
            </h3>
            <p class="title-desc">
                Cadastre os novos cursos no link abaixo
            </p>
            <a href="{{ route('cursos::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Novo Curso
            </a>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12 admin-box form-group box grid-item--width2">
            <h3>
                <a href="{{ route('atividadesTipos::index') }}" class="title-box">
                    <small style="color:#131313"><i class="fa fa-calendar" aria-hidden="true"></i></small>
                    Tipos de Atividade
                </a>
            </h3>
            <p class="title-desc">
                Cadastre os novos tipos de atividade no link abaixo
            </p>
            <a href="{{ route('atividadesTipos::adicionar') }}" style="color: #1a1a1a">
                <small><i class="fa fa-plus" aria-hidden="true"></i></small>
                Novo Tipo de Atividade
            </a>
        </div>
    </div>
    {{ Html::script('/js/masonry.pkgd.min.js') }}
    <script type="text/javascript">
        $('.grid').masonry({
            itemSelector: '.grid-item--width2',
            percentPosition: true,
            transitionDuration: '1.5s',
            resize: true,
            horizontalOrder: true
        });
    </script>
@endsection