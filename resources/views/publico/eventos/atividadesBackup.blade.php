@extends('layouts.eventoLayout')
@section('title', "- ".$evento->nome)
@section('content')
    <h1>{{ $evento->nome }}</h1>
    @if (!Auth::guest())
        @if(!$evento->isParticipante(Auth::user()->id))
            {{ Form::open(['url' => route('eventosPublico::participar', ['nomeSlug' => $evento->nomeSlug]), 'method' => 'POST', 'class' => 'pull-right']) }}
            <button class="button button-green" type="submit" role="button">
                <i class="fa fa-plus" aria-hidden=""></i> Participar
            </button>
            {{ Form::close() }}
        @endif
    @endif
    <h2>Lista de Atividades do evento e subeventos:</h2>
    <hr/>
    <h3>Evento: {{$evento->nome}}</h3>
    <div class="row" id="{{$evento->nomeSlug}}">
        @forelse($atividades as $atividade)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div id="masonry-grid">
                    <div class="gutter-sizer grid-item">
                        <div class="card card-block">
                            <h2 class="card-title">{{ $atividade->nome }}</h2>
                            <h4>
                                <small>Unidade:</small>
                                {{ $atividade->unidade->nome or "Não alocado" }}
                            </h4>
                            <h4 class="card-title">
                                <small>Local:</small>
                                {{ $atividade->local->nome or "Não alocado" }}
                            </h4>
                            <h4 class="card-title">
                                <small>Sala:</small>
                                {{ $atividade->sala->nome or "Não alocado" }}
                            </h4>
                            <h4 class="card-title">
                                <small>Datas e Horários:</small>
                                <ul class="list-unstyled">
                                    @foreach($atividade->atividadesDatasHoras->sortBy('data') as $atividadeDataHora)
                                        <li>
                                            {{$atividadeDataHora->data->formatLocalized("%d de %B de %G")}} de
                                            {{$atividadeDataHora->horarioInicio->format("H:i")}}h às
                                            {{$atividadeDataHora->horarioTermino->format("H:i")}}h
                                        </li>
                                    @endforeach
                                </ul>
                            </h4>
                            <h4 class="card-title">
                                <small>Vagas Restantes:</small>
                                {{ $atividade->quantidadeVagas - $atividade->participantes_count }}
                            </h4>
                            <div class="espacos"></div>
                            <button class="button button-cyan" data-id="{{ $atividade->id }}" data-toggle="modal"
                                    data-target="#showActivity"><i class="fa fa-plus"></i> Saiba Mais
                            </button>
                            @if(Auth::check())
                                @if($evento->isParticipante(Auth::user()->id) and \Carbon\Carbon::now()->between($evento->dataInicioInscricao, $evento->dataFimInscricao))
                                    @if(!$atividade->isParticipante(Auth::user()->id))
                                        <a href="{{ route('eventosPublico::participarAtividade', $atividade->id) }}"
                                           class="button button-green"><i class="fa fa-plus"></i>
                                            Participar</a>
                                    @else
                                        <a href="{{ route('eventosPublico::revogarParticipacaoAtividade', $atividade->id) }}"
                                           class="button button-orange"><i class="fa fa-minus"></i>
                                            Abandonar</a>
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="espacos"></div>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <p class="paragrafo">Não há atividades</p>
            </div>
        @endforelse
    </div>
    {{$atividades->links()}}
    <div class="modal fade" id="showActivity" role="dialog" aria-labelledby="showActivityLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
        $('#showActivity').on('show.bs.modal', function (event) {
            var botao = $(event.relatedTarget);
            var idActivity = botao.data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '{{ url('/evento/atividade') }}/' + idActivity,
                dataType: 'json'
            }).done(function (data) {
                $('.modal-content').fadeOut('slow', function () {
                    $('.modal-content').html(data);
                    $('.modal-content').fadeIn('slow');
                });
            }).fail(function () {
                $('#showActivity').modal('hide');
            });

        });
        var $container = jQuery('#masonry-grid');
        // initialize
        $container.masonry({
            columnWidth: 200,
            itemSelector: '.grid-item'
        });
    </script>
@endsection
