@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <h1>Certificados {{ $evento->nome }}</h1>
    @if($evento->participantes->where('id', \Auth::user()->id)->first()->pivot->presenca)
        <h2>Certificado do evento</h2>
        {{ Form::open(['url' => route('eventos::certificarEvento', ['nomeSlug' => $evento->nomeSlug]), 'method' => 'POST']) }}
            {{ Form::submit('Certificação', ['class' => 'button button-blue']) }}
        {{ Form::close() }}
    @endif
    <h2>Certificado de Atividades</h2>
    @forelse($atividadesCertificadas as $atividadeCertificada)
        {{ Form::open(['url' => route('eventos::certificarAtividade', ['id' => $atividadeCertificada->id]), 'method' => 'POST']) }}
            {{ Form::submit($atividadeCertificada->nome, ['class' => 'button button-blue']) }}
        {{ Form::close() }}
        <hr/>
        @empty
        <p>Não há certificados</p>
    @endforelse
    <h2>Certificado de Trabalhos</h2>
    @forelse($trabalhosCertificados as $trabalhosCertificado)
        @if($trabalhosCertificado->relacaoTrabalho == 1)
            {{ Form::open(['url' => route('eventos::certificarAutor', ['id' => $trabalhosCertificado->id]), 'method' => 'POST']) }}
            {{ Form::submit("Certificado Autor - ".$trabalhosCertificado->tituloTrabalho, ['class' => 'button button-blue']) }}
            {{ Form::close() }}
            @if($trabalhosCertificado->apresentacao == 1)
                {{ Form::open(['url' => route('eventos::certificarBanner', ['id' => $trabalhosCertificado->id]), 'method' => 'POST']) }}
                {{ Form::submit("Certificado Apresentação de Banner - ".$trabalhosCertificado->tituloTrabalho, ['class' => 'button button-blue']) }}
                {{ Form::close() }}
            @elseif($trabalhosCertificado->apresentacao == 2)
                {{ Form::open(['url' => route('eventos::certificarOral', ['id' => $trabalhosCertificado->id]), 'method' => 'POST']) }}
                {{ Form::submit("Certificado Apresentação Oral - ".$trabalhosCertificado->tituloTrabalho, ['class' => 'button button-blue']) }}
                {{ Form::close() }}
            @endif
        @elseif($trabalhosCertificado->relacaoTrabalho == 2)
            {{ Form::open(['url' => route('eventos::certificarRevisor', ['id' => $trabalhosCertificado->id]), 'method' => 'POST']) }}
            {{ Form::submit("Certificado Revisor - ".$trabalhosCertificado->tituloTrabalho, ['class' => 'button button-blue']) }}
            {{ Form::close() }}
        @endif
        <hr/>
    @empty
        <p>Não há certificados</p>
    @endforelse
@endsection
