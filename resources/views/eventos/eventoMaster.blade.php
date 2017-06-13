@extends('layouts.new_layout')
@section('title', "- Eventos")
@section('content')
    <div id="wrapper">
        <div class="row">
            <div class="conteiner">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                    <header>
                        <h1>Evento X</h1>
                        <p class="paragrafo">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </header>
                </div>
            </div>
        </div>
    @include('eventos.components.listaEventos')
@endsection
