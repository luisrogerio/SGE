@extends('layouts.layout')
@section('title', 'Evento')
@section('content')
    <h1>Evento</h1>
    <div class="container">
        @foreach($eventos as $evento)
            <div class="row">
                <div class="col-md-2">
                    <!--<img src="/imagens/1.png" class="img-thumbnail img-circle" >-->
                    <img src="/uploads/eventos/{!!$evento->id!!}/logo.jpg" class="img-thumbnail img-circle" >
                </div>
                <div class="col-md-10">
                    <h3> {{$evento->nome}}</h3>
                    <blockquote>
                        <p>{!! $evento->descricao !!}}</p>
                    </blockquote>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                {{link_to_action('EventosController@getAdicionar','Adicionar Novo', null, ['class' => 'btn btn-primary'])}}
            </div>
        </div>
    </div>
    {{$eventos->links()}}
    @include('layouts.confirmarDelecao')
@endsection