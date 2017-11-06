@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <h1>{{ $evento->nome }}</h1>
    @if (!Auth::guest())
        @if(!$evento->isParticipante(Auth::user()->id))
            {{ Form::open(['url' => route('eventosPublico::participar', ['nomeSlug' => $evento->nomeSlug]),
                'method' => 'POST', 'class' => 'pull-right']) }}
            <button class="button button-green" type="submit" role="button">
                <i class="fa fa-plus" aria-hidden=""></i> Participar
            </button>
            {{ Form::close() }}
        @endif
    @endif
    <h2>Galeria</h2>
    <hr/>
    <p class="paragrafo">
        Não há imagens para mostrar
    </p>
@endsection
