@extends('layouts.eventoPublico')
@section('title', 'Autenticação do Certificado')
@section('content')
    <div class="espacos"></div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Sistema de Gestão de Eventos do IF Sudeste MG</h3>
                    <h3>Sistema de Autenticação de Certificados do SGE - IF Sudeste MG</h3>
                </div>
                <div class="panel-body">
                    <p class="text-justify">
                        Para o código fornecido, seguem informações para averiguar a veracidade do certificado:
                    </p>
                    <p class="text-justify">{!! $informacoes !!}</p>
                    <p class="text-justify">
                        Qualquer dúvida, entre em contato com os administradores do evento.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
