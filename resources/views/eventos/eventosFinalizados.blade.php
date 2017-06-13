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
                        <li role="presentation" class=""><a href="#">Resumo Geral</a></li>
                        <li role="presentation" class="active"><a href="#">Eventos Finalizados</a></li>
                        <li role="presentation" class=""><a href="#">Eventos Finalizados em Época</a></li>
                        <li role="presentation" class=""><a href="#">Evento aberto para atividades</a></li>
                        <li role="presentation" class=""><a href="#"><i class="fa fa-gear"></i> Configurações</a></li>
                    </ul>
                </header>

                <section class="evento-conteiner">
                    <div class="row">
                        <div class="conteiner">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="panel panel-default">
                                    <h3>Eventos Finalizados <small>Detalhes em tabela</small></h3>
                                    @include('eventos.components.tabela')
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>

            </div>
        </div>
    </div>
</div>
@endsection
