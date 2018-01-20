
<head>
    <!--Informações de Dispositivo para Bootstrap 3-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--CSS para Bootstrap, Select e Ícones-->
    {{ Html::favicon('http://www.jf.ifsudestemg.edu.br/imagens/ifet.ico') }}
    {{ Html::style('css/bootstrap.min.css') }}
    <title>SGE - Lista de Presença</title>
    <style type="text/css">
        table {
            page-break-inside: auto;
            page-break-after: always;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
{{ Html::script('js/bootstrap.js') }}
<div class="container">
    @foreach($atividade->atividadesDatasHoras as $atividadeDataHora)
        @foreach($participantesPorLetra as $letra => $participantes)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th colspan="2">
                        <img src="{{ asset('uploads/eventos/1/cabecalhoEvento.png') }}" width="100%">
                        <h4>Lista de Presença
                            - {{ $atividadeDataHora->atividade->nome }}
                            ({{ $atividadeDataHora->data->format('d/m/Y') }}
                            de {{ $atividadeDataHora->horarioInicio->format('H:i') }}h
                            até {{ $atividadeDataHora->horarioTermino->format('H:i') }}h)</h4>
                    </th>
                </tr>
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        Assinatura
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($participantes as $participante)
                    <tr>
                        <td colspan="2">
                            <div class="text-uppercase">
                                {{ $participante }}
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="page-break"></div>
        @endforeach
        <div class="page-break"></div>
    @endforeach
</div>
</body>