@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <style>
        .row > [class*='col-']:before {
            background: #c6c6c6;
            bottom: 0;
            content: " ";
            left: 0;
            position: absolute;
            width: 1px;
            top: 0;
        }

        .row > [class*='col-']:first-child:before {
            display: none;
        }
    </style>
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
    <h2>Minha Agenda</h2>
    <hr/>
    @for($i = 0; $i < ceil(count($diasDoEvento) / 5); $i++)
        <div class="row">
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
            </div>
            @foreach($diasDoEvento->forPage($i+1, 5) as $diaDoEvento)
                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                    <p class="paragrafo text-center"><strong>{{ $diaDoEvento->formatLocalized('%d de %B') }}</strong>
                    </p>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                <p class="paragrafo">Manhã</p>
            </div>
            @foreach($diasDoEvento->forPage($i+1, 5) as $diaDoEvento)
                <div class="col-lg-2 col-md-2 text-center">
                    @foreach($atividadesDatasHoras
                                ->filter( function ($dataHora) use ($diaDoEvento) { return ($dataHora->data->eq($diaDoEvento)); })
                                ->filter( function ($dataHora) { return $dataHora->horarioInicio->gt(\Carbon\Carbon::createFromFormat('H:i:s', '03:00:00')) && $dataHora->horarioInicio->lte(\Carbon\Carbon::createFromFormat('H:i:s', '12:00:00'));})
                                as $atividadeDataHora)
                        <div class="visible-xs visible-sm">
                            {{ $atividadeDataHora->data->formatLocalized('%d de %B') }}
                        </div>
                        <p class="text-center">
                            <strong>{{ $atividadeDataHora->horarioInicio->formatLocalized('%H:%Mh') }} até
                                {{ $atividadeDataHora->horarioTermino->formatLocalized('%H:%Mh') }} </strong> -
                            {{ $atividadeDataHora->atividade->nome }}. <strong>Local:</strong>
                            {{ $atividadeDataHora->atividade->unidade->nome }} -
                            {{ $atividadeDataHora->atividade->local->nome }} -
                            {{ $atividadeDataHora->atividade->sala->nome }}
                        </p>
                        <div class="divider"></div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                <p class="paragrafo">Tarde</p>
            </div>
            @foreach($diasDoEvento->forPage($i+1, 5) as $diaDoEvento)
                <div class="col-lg-2 col-md-2 text-center">
                    @foreach($atividadesDatasHoras
                                ->filter( function ($dataHora) use ($diaDoEvento) { return ($dataHora->data->eq($diaDoEvento)); })
                                ->filter( function ($dataHora) { return $dataHora->horarioInicio->gt(\Carbon\Carbon::createFromFormat('H:i:s', '12:00:00')) && $dataHora->horarioInicio->lte(\Carbon\Carbon::createFromFormat('H:i:s', '18:00:00'));})
                                 as $atividadeDataHora)
                        <div class="visible-xs visible-sm">
                            {{ $atividadeDataHora->data->formatLocalized('%d de %B') }}
                        </div>
                        <p class="text-center">
                            <strong>{{ $atividadeDataHora->horarioInicio->formatLocalized('%H:%Mh') }} até
                                {{ $atividadeDataHora->horarioTermino->formatLocalized('%H:%Mh') }} </strong> -
                            {{ $atividadeDataHora->atividade->nome }}. <strong>Local:</strong>
                            {{ $atividadeDataHora->atividade->unidade->nome }} -
                            {{ $atividadeDataHora->atividade->local->nome }} -
                            {{ $atividadeDataHora->atividade->sala->nome }}
                        </p>
                        <div class="divider"></div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                <p class="paragrafo">Noite</p>
            </div>
            @foreach($diasDoEvento->forPage($i+1, 5) as $diaDoEvento)
                <div class="col-lg-2 col-md-2 text-center">
                    @foreach($atividadesDatasHoras
                                ->filter( function ($dataHora) use ($diaDoEvento) { return ($dataHora->data->eq($diaDoEvento)); })
                                ->filter( function ($dataHora) { return $dataHora->horarioInicio->gt(\Carbon\Carbon::createFromFormat('H:i:s', '18:00:00')) && $dataHora->horarioInicio->lte(\Carbon\Carbon::createFromFormat('H:i:s', '03:00:00'));})
                                                as $atividadeDataHora)
                        <div class="visible-xs visible-sm">
                            {{ $atividadeDataHora->data->formatLocalized('%d de %B') }}
                        </div>
                        <p class="text-center">
                            <strong>{{ $atividadeDataHora->horarioInicio->formatLocalized('%H:%Mh') }} até
                                {{ $atividadeDataHora->horarioTermino->formatLocalized('%H:%Mh') }} </strong> -
                            {{ $atividadeDataHora->atividade->nome }}. <strong>Local:</strong>
                            {{ $atividadeDataHora->atividade->unidade->nome }} -
                            {{ $atividadeDataHora->atividade->local->nome }} -
                            {{ $atividadeDataHora->atividade->sala->nome }}
                        </p>
                        <div class="divider"></div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endfor
@endsection
