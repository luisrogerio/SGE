<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{$atividade->tipoDeAtividade->nome}} - {{ $atividade->nome }}</h4>
</div>
<div class="modal-body">
    <h3>Descrição</h3>
    <p>{{ $atividade->descricao }}</p>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
            <h4>Total de Vagas</h4>
            <p class="text-capitalize">{{ $atividade->quantidadeVagas }}</p>
            <h4>Vagas Restantes</h4>
            <p class="text-capitalize">{{ $atividade->quantidadeVagas - $atividade->participantes_count}}</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
            <h4>Local da Atividade</h4>
            @if ($atividade->sala)
                {{ $atividade->unidade->nome}}
                {{ $atividade->local->nome }}
                {{ $atividade->sala->tipoDeEspaco->nome }}
                {{ $atividade->sala->nome}}
            @else
                Não alocado
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($atividade->atividadesResponsaveis as $atividadeResponsavel)
            <div class="col-lg-4 col-md-6 col-xs-12">
                <h4>Nome </h4>
                <p>{{ $atividadeResponsavel->nome }}</p>
                <h4>Titulação </h4>
                <p>{{$atividadeResponsavel->titulacao}}</p>
                <h4>Instituição de Origem </h4>
                <p>{{$atividadeResponsavel->instituicaoOrigem}}</p>
                <h4>Experiência Profissional </h4>
                <p>{{$atividadeResponsavel->experienciaProfissional}}</p>
            </div>
        @endforeach
    </div>
    <h4>Datas e Horários</h4>
    <div class="row">
        @foreach($atividade->atividadesDatasHoras->sortBy("data") as $atividadeDataHora)
            <div class="col-lg-12 col-md-12 col-xs-12">
                <p>{{$atividadeDataHora->data->formatLocalized("%d de %B de %G")}}
                    de {{$atividadeDataHora->horarioInicio->format("H:i")}}h
                    às {{$atividadeDataHora->horarioTermino->format("H:i")}}h</p>
            </div>
        @endforeach
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="button button-blue" data-dismiss="modal">Cancelar</button>
    @if(Auth::check())
        @if($atividade->evento->isParticipante(Auth::user()->id) and \Carbon\Carbon::now()->between($atividade->evento->dataInicioInscricao, $atividade->evento->dataFimInscricao))
            @if(!$atividade->isParticipante(Auth::user()->id))
                <button type="button" class="button button-green">
                    <a href="{{ route('eventosPublico::participarAtividade', $atividade->id) }}" style="color: #fff"><i
                                class="fa fa-plus"></i>
                        Participar</a>
                </button>
            @else
                <a href="{{ route('eventosPublico::revogarParticipacaoAtividade', $atividade->id) }}"
                   class="button button-orange"><i class="fa fa-minus"></i>
                    Abandonar</a>
            @endif
        @endif
    @endif
</div>