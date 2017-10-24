@extends('layouts.eventoLayout')
@section('title', "- Eventos")
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
            <h2>Apresentação</h2>
            <p class="paragrafo">
                {{ $evento->descricao }}
            </p>
            <h2>Comissão Organizadora</h2>
            <p class="paragrafo">
                <pre>{{ $evento->comissaoOrganizadora }}</pre>
            </p>
            <h2>Público-Alvo</h2>
            <p class="paragrafo">
                {{ $evento->publicoAlvo }}
            </p>
            @if($evento->eventoEdicaoAnterior != null)
                <h2>Edição Anterior</h2>
                <a href="{{ route('eventosPublico::visualizar', ['nomeSlug' => $evento->eventoEdicaoAnterior->nomeSlug]) }}">
                    <button class="button button-blue">
                        {{ $evento->eventoEdicaoAnterior->nome }}
                    </button>
                </a>
            @endif
            @if(!$evento->eventosFilhos->isEmpty())
                <h2>Sub-Eventos</h2>
                <ul>
                    @foreach($evento->eventosFilhos as $subevento)
                        <li>
                            <strong>{{$subevento->nome}}</strong> {{ $subevento->descricao }}
                        </li>
                    @endforeach
                </ul>
            @endif
            <h2>Contatos</h2>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="thumbnail">
                            <div class="caption">
                                @foreach($evento->eventosContatos as $eventoContato)
                                    <p>
                                    <address>
                                        <strong>{{ $eventoContato->nome }}</strong><br>
                                        @if($eventoContato->telefone)
                                            Telefone: {{$eventoContato->telefone}}<br>
                                        @endif
                                        @if($eventoContato->telefone)
                                            Celular: {{$eventoContato->celular}}<br>
                                        @endif
                                        Email: {{ $eventoContato->email }}<br>
                                        @if($eventoContato->redesSociais[0])
                                            Facebook: {!! link_to($eventoContato->redesSociais[0]) !!}
                                            <br>
                                        @endif
                                        @if($eventoContato->redesSociais[1])
                                            Twitter: {{$eventoContato->redesSociais[1]}}<br>
                                        @endif
                                    </address>
                                    </p>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
