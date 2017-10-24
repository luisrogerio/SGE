@extends('layouts.eventoPublico')

@section('content')
    <div class="espacos"></div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Sistema de Gestão de Eventos do IF Sudeste MG</h3>
                </div>
                <div class="panel-body">
                    <p class="text-justify">
                        Olá {{ Auth::user()->nome }}, para navegação utilize a barra no menu acima. Seja Bem-Vindo ao
                        Sistema de Gestão de Eventos do Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais.
                    </p>
                    <p class="text-justify">
                        Esse Sistema é de autoria de um Projeto de Extensão do Campus Juiz de Fora em parceria com a Reitoria dos Campi.
                        Caso tenha qualquer dúvida sobre o sistema e seu uso, contate a Diretoria de Extensão e Relações Comunitárias para mais informações.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
