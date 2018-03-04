@extends('layouts.layout_admin')
@section('title', 'Atividade')
@section('content')
    <h1>Atividades do evento - {{ $evento->nome }}</h1>
    <a href="{{ route('eventos::listasDePresencas',['nomeSlug' => $evento->nomeSlug]) }}" style="color: #fff;"
       target="_blank">
        <button class="button button-cyan">
            Todas as Listas de Presença
        </button>
    </a>
    <div class="espacos"></div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nome</th>
            <th colspan="2" class="text-center">Opções</th>
        </tr>
        @foreach($atividades as $atividade)
            <tr>
                <td>{{$atividade->nome}} <br/>
                    @foreach($atividade->atividadesDatasHoras as $atividadesDataHora)
                        ({{ $atividadesDataHora->data->format('d/m/Y') }} às {{ $atividadesDataHora->horarioInicio->format('H:i') }}h até {{ $atividadesDataHora->horarioTermino->format('H:i') }}h) <br/>
                    @endforeach
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="button button-blue dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Ações <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li></li>
                            <li><a href="{{ route('eventos::lancamentoDePresenca', ['id' => $atividade->id]) }}">Lançamento de Presença</a></li>
                            <li><a href="#">Lançamento Extra</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('eventos::listaDePresenca', ['id' => $atividade->id]) }}"
                                   target="_blank">
                                    Lista de Presença
                                </a></li>
                            <li><a href="{{ route('eventos::certificarMinistrantes', ['id' => $atividade->id]) }}"
                                   target="_blank">
                                    Certificar Ministrantes
                                </a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                <div class="btn-group">
                    <a href="{{ route('eventos::visualizar',['id' => $evento->id], ['style' => 'color:#fff;']) }}">
                        <button class="button button-green">
                            Voltar
                        </button>
                    </a>
                </div>
            </td>
        </tr>
    </table>
    {{$atividades->links()}}
@endsection