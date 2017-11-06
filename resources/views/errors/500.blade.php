@extends('layouts.eventoPublico')
@section('title', "- Eventos")
@section('content')
    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <div class="logo">
                    <h1>Erro 500 - Erro Interno</h1>
                </div>
                <p class="lead text-muted">Houve um erro interno no servidor, desculpe o incômodo</p>
                <div class="clearfix"></div>
                <div class="sr-only">
                    &nbsp;
                </div>
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="btn-group btn-group-justified">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                        <a href="{{ route('eventosPublico::index') }}" class="btn btn-success">Página Principal</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- /.col-lg-8 col-offset-2 -->
        </div>
    </div>
@endsection