@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <h1>{{ $evento->nome }}</h1>
    <h2>Galeria</h2>
    <hr/>
    <p class="paragrafo">
        Não há imagens para mostrar
    </p>
@endsection
