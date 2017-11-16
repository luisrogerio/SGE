@extends('layouts.eventoPublico')
@section('title', 'Página Inicial')
@section('content')
    <div class="espacos"></div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Sistema de Gestão de Eventos do IF Sudeste MG</h3>
                </div>
                <div class="panel-body">
                    <p class="text-justify">
                        Olá {{ Auth::user()->nome }}, Seja Bem-Vindo ao
                        Sistema de Gestão de Eventos (SGE) do Instituto Federal de Educação, Ciência e Tecnologia do
                        Sudeste de Minas Gerais.
                    </p>
                    <p class="text-justify">O SGE está sendo desenvolvido dentro de um projeto de Treinamento
                        Profissional II, do Campus Juiz de Fora, em parceria com a Reitoria.
                        Caso tenha qualquer dúvida sobre o sistema e seu uso, contate a Diretoria de Extensão e Relações
                        Comunitárias (DERC-JF).</p>
                    <p class="text-justify">A Equipe de Desenvolvimento do projeto é composta por Luís Rogério, Raissa
                        Fonseca, Allan Garcez e José Honório Glanzmann.</p>
                    <p class="text-justify">Agradecimentos especiais às equipes de TI do Campus Juiz de Fora e da
                        Reitoria.</p>
                    <p class="text-justify">Para navegação utilize a barra no menu acima.</p>
                    <p class="text-justify">Atenciosamente,</p>
                    <p class="text-justify">Equipe Desenvolvedora do SGE</p>
                </div>
            </div>
        </div>
    </div>
@endsection
