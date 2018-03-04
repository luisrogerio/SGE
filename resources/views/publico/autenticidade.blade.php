@extends('layouts.eventoPublico')
@section('title', 'Autenticação do Certificado')
@section('content')
    <div class="espacos"></div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Sistema de Gestão de Eventos do IF Sudeste MG</h3>
                </div>
                <div class="panel-body">
                    <p class="text-justify">
                        Segue informações sobre o certificado:
                    </p>
                    <p class="text-justify">{!! $informacoes !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
