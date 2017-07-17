@extends('layouts.eventoLayout')
@section('title', "- Eventos")
@section('content')
    <div id="wrapper">
        <div class="row">
            <div class="conteiner">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                    <header>
                        <h1>{{ $evento->nome }}</h1>
                        <p class="paragrafo">
                            {{ $evento->descricao }}
                        </p>
                    </header>

                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{--@include('eventos.components.galeriaEventos')--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="conteiner">
            <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                <h2>Lista de Atividades do evento e subeventos: {{ $evento->nome }}</h2>
                <form action="#" class="form-group">
                    <div class="input-group input-group-select">
                        <input type="text" name="pesquisar" class="form-control" placeholder="Busca...">
                        <select name="pesquisa" class="form-control">
                            <option value="subevento">Subevento</option>
                            <option value="curso">Curso</option>
                        </select>
                    </div>
                    <button type="submit" class="button button-cyan"><i class="fa fa-search" aria-hidden="true"></i>
                        Pesquisar
                    </button>
                </form>
                <hr/>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="well">
                                <header>
                                    <h3>{{ $evento->nome }}</h3>
                                </header>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($evento->atividades as $atividade)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h2>{{$atividade->nome}}</h2>
                                        <p>{{$atividade->descricao}}</p>
                                        <ul class="fa-ul">
                                            <li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Datas:<br>
                                                @foreach($atividade->atividadesDatasHoras as $atividadeDataHora)
                                                    {{$atividadeDataHora->data->format('d/m/Y')}}
                                                    de {{$atividadeDataHora->horarioInicio->format('H:i')}}h
                                                    às {{ $atividadeDataHora->horarioTermino->format('H:i') }}h<br>

                                                    @php
                                                        //Código inseguro, MELHORAR ISSO NO BANCO

                                                        $unidade = $atividadeDataHora->unidade;
                                                        $local = $atividadeDataHora->local;
                                                        $sala = $atividadeDataHora->sala;
                                                    @endphp
                                                @endforeach
                                            </li>
                                            <li><i class="fa-li fa fa-chevron-right"
                                                   aria-hidden="true"></i>Local: {{ $atividade->unidade->nome }}
                                                - {{ $atividade->local->nome }} - {{ $atividade->sala->nome }}</li>
                                            <li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Cursos:
                                                @php
                                                    $cursosSiglas = "";
                                                @endphp
                                                @foreach($atividade->cursos as $curso)
                                                    @php
                                                        $cursosSiglas .= $curso->nome;
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($cursosSiglas, ',') }}
                                            </li>
                                        </ul>
                                        <hr>
                                        <p>
                                            <a href="#" class="button button-green" role="button"><i
                                                        class="fa fa-plus"
                                                        aria-hidden="true"></i>
                                                Inscrever</a>
                                            Vagas restantes: <strong>5</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{--@for($i = 0; $i < 3; $i+=1)--}}
                    {{--<div class="container">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                {{--<div class="well">--}}
                                    {{--<header>--}}
                                        {{--<h3>Título</h3>--}}
                                    {{--</header>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="row">--}}
                            {{--@for($j = 0; $j < 3; $j+=1)--}}
                                {{--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">--}}
                                    {{--<div class="thumbnail">--}}
                                        {{--<div class="caption">--}}
                                            {{--<h2>Atividades</h2>--}}
                                            {{--<p>Mussum Ipsum</p>--}}
                                            {{--<ul class="fa-ul">--}}
                                                {{--<li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Ola</li>--}}
                                                {{--<li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Ola</li>--}}
                                                {{--<li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Ola</li>--}}
                                                {{--<li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Ola</li>--}}
                                                {{--<li><i class="fa-li fa fa-chevron-right" aria-hidden="true"></i>Ola</li>--}}
                                            {{--</ul>--}}
                                            {{--<hr>--}}
                                            {{--<p>--}}
                                                {{--<a href="#" class="button button-green" role="button"><i--}}
                                                            {{--class="fa fa-plus"--}}
                                                            {{--aria-hidden="true"></i>--}}
                                                    {{--Inscrever</a>--}}
                                                {{--Vagas restantes: <strong>5</strong>--}}
                                            {{--</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endfor--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endfor--}}
            </div>
        </div>
    </div>
@endsection
