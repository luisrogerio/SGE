@extends('layouts.new_layout')
@section('title', "- Eventos")
@section('content')
    <div id="wrapper">
        <div class="row">
            <div class="conteiner">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                    <header>
                        <h1 class="text-center">Tela de Eventos</h1>
                        <h6 class="text-center">Se você acha que sabe programar, conheça o Luis para se arrasar</h6>
                        <ul class="nav nav-tabs nav-pills centered">
                            <li role="presentation" class="active"><a href="#">Resumo Geral</a></li>
                            <li role="presentation" class=""><a href="#">Eventos Finalizados</a></li>
                            <li role="presentation" class=""><a href="#">Eventos Finalizados em Época</a></li>
                            <li role="presentation" class=""><a href="#">Evento aberto para atividades</a></li>
                        </ul>
                    </header>

                    <section class="evento-conteiner">
                        <div class="row">
                            <div class="conteiner">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">
                                            <h3>Lista geral dos eventos</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p>
                                                Insere uma caralhada de texto aquiInsere uma caralhada de texto
                                                aquiInsere uma caralhada de texto aquiInsere uma caralhada de texto
                                                aquiInsere uma caralhada de texto aquiInsere uma caralhada de texto
                                                aquiInsere uma caralhada de texto aquiInsere uma caralhada de texto
                                                aquiInsere uma caralhada de texto aquiInsere uma caralhada de texto
                                                aquiInsere uma caralhada de texto aqui
                                            </p>
                                        </div>
                                        <!-- Table -->
                                        @include('eventos.components.tabela')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('eventos.components.thumbnails')
                            @include('eventos.components.thumbnails')
                            @include('eventos.components.thumbnails')
                            @include('eventos.components.thumbnails')
                            @include('eventos.components.thumbnails')
                            @include('eventos.components.thumbnails')
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection
