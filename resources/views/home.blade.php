@extends('layouts.layoutPublico')

@section('content')
    <div class="espacos"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Bem-vindo ao Sistema Gerenciador de Eventos do IF Sudeste MG</h3>

                    </div>
                    <div class="panel-body">
                        <p class="text-justify">
                            Olá {{ Auth::user()->nome }}, para navegação utilize a barra no menu acima.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-lg-offset-3 col-lg-6 col-md-6">
                        <h3 class="text-center">Menu de Ajuda</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
