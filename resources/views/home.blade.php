@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Sistema Gerenciador de Eventos do IF Sudeste MG</div>

                    <div class="panel-body">
                        Seja bem-vindo {{ Auth::user()->nome }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
