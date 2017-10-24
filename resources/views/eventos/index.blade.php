@extends('layouts.layout_admin')
@section('title', 'Evento')
@section('content')
    <h1>Evento</h1>
    <div class="container">
        @foreach($eventos as $evento)
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ asset($evento->eventoCaracteristica->logo) }}"
                         class="img-thumbnail img-circle">
                </div>
                <div class="col-md-10">
                    <a href="{{ route('eventos::visualizar', array('id' => $evento->id)) }}" class="h3">
                        <small><i class="glyphicon glyphicon-log-in"></i></small> {{$evento->titulo }}</a>
                    <blockquote>
                        <p>{!! $evento->descricao !!}</p>
                    </blockquote>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('eventos::adicionar') }}">
                    <button class="button button-blue">
                        Adicionar Novo
                    </button>
                </a>
                <a href="{{ route('admin::index') }}">
                    <button class="button button-green">
                        Voltar
                    </button>
                </a>
            </div>
        </div>
    </div>
    {{$eventos->links()}}
    @include('layouts.confirmarDelecao')
@endsection