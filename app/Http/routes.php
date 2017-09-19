<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/composer', function(){
    Artisan::call('db:seed');
});

Route::get('/', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/cadastro', 'Auth\AuthController@getCadastro');
Route::post('/cadastroExterno', 'Auth\AuthController@getCadastroExterno');
Route::post('/salvarExterno', 'Auth\AuthController@postSalvarExterno');
Route::get('/cadastroAluno', 'Auth\AuthController@getCadastroAluno');


// Password Reset Routes...
Route::get('reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('reset', 'Auth\PasswordController@reset');

//Route::controller('/locais','LocaisController');

//Route::controller('/atividadesTipos','AtividadesTiposController');

//Route::controller('/cursos', 'CursosController');

//Route::controller('/statusdeatividade', 'AtividadesStatusConroller');

//Route::controller('/gruposdeusuario', 'UsuariosGruposController');

//Route::controller('/atividades', 'AtividadesController');

//Route::controller('/eventos', 'EventosController');

//Route::controller('/contatos', 'EventosContatosController');

Route::group(['prefix' => 'eventos/', 'as' => 'eventosPublico::',], function () {

    Route::get('/', ['as' => 'index', 'uses' => 'EventosController@getIndexPublico',]);
    Route::get('/atividades/{nomeSlug}', ['as' => 'atividadesEvento', 'uses' => 'EventosController@getAtividadesPublico',]);
    Route::get('/{nomeSlug}', ['as' => 'visualizar', 'uses' => 'EventosController@getVisualizarPublico']);
//    Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EventosController@getAdicionar']);
//    Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosController@getEditar']);
//    Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EventosController@postSalvar']);
//    Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosController@patchAtualizar']);
//    Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosController@postExcluir']);
//    Route::get('/subeventos', ['as' => 'paginacaoSubeventos', 'uses' => 'EventosController@getSubeventos']);
//    Route::post('/salvarLinkExterno', ['as' => 'salvarLinkExterno', 'uses' => 'EventosController@salvarLinkExterno']);
//
//    Route::group(['prefix' => '{idPai?}'], function ($idPai = 0) {
//        Route::get('/adicionar', ['as' => 'adicionarSubevento', 'uses' => 'EventosController@getAdicionar']);
//        Route::post('/salvar', ['as' => 'salvarSubevento', 'uses' => 'EventosController@postSalvar']);
//    });
});


Route::group(['prefix' => 'admin/'], function () {

    Route::get('/', ['uses' => 'HomeController@indexAdmin']);

    Route::group(['prefix' => 'salas/', 'as' => 'salas::'], function () {
        Route::get('/{idLocais}', ['as' => 'index', 'uses' => 'SalasController@getIndex']);
        Route::get('/adicionar/{idLocais}', ['as' => 'adicionar', 'uses' => 'SalasController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'SalasController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'SalasController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'SalasController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'SalasController@postExcluir']);
        Route::post('/getSalas/{idLocais}', ['as' => 'getSalas', 'uses' => 'SalasController@getSalasByLocais']);
    });

    Route::group(['prefix' => 'locais/', 'as' => 'locais::'], function () {
        Route::get('/{idUnidades}', ['as' => 'index', 'uses' => 'LocaisController@getIndex']);
        Route::get('/adicionar/{idUnidades}', ['as' => 'adicionar', 'uses' => 'LocaisController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'LocaisController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'LocaisController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'LocaisController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'LocaisController@postExcluir']);
        Route::post('/getLocais/{idUnidades}', ['as' => 'getLocais', 'uses' => 'LocaisController@getLocaisByUnidade']);
    });

    Route::group(['prefix' => 'unidades/', 'as' => 'unidades::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UnidadesController@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'UnidadesController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'UnidadesController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'UnidadesController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'UnidadesController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'UnidadesController@postExcluir']);
    });

    Route::group(['prefix' => 'atividadesTipos/', 'as' => 'atividadesTipos::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AtividadesTiposController@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'AtividadesTiposController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'AtividadesTiposController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'AtividadesTiposController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'AtividadesTiposController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'AtividadesTiposController@postExcluir']);
    });

    Route::group(['prefix' => 'cursos/', 'as' => 'cursos::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CursosController@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'CursosController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'CursosController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'CursosController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'CursosController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'CursosController@postExcluir']);
    });

    Route::group(['prefix' => 'statusdeatividade/', 'as' => 'statusdeatividade::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AtividadesStatusConroller@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'AtividadesStatusConroller@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'AtividadesStatusConroller@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'AtividadesStatusConroller@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'AtividadesStatusConroller@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'AtividadesStatusConroller@postExcluir']);
    });

    Route::group(['prefix' => 'gruposdeusuario/', 'as' => 'gruposdeusuario::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UsuariosGruposController@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'UsuariosGruposController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'UsuariosGruposController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'UsuariosGruposController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'UsuariosGruposController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'UsuariosGruposController@postExcluir']);
    });

    Route::group(['prefix' => 'atividades/', 'as' => 'atividades::'], function () {
        Route::get('/{idEventos}', ['as' => 'index', 'uses' => 'AtividadesController@getIndex']);
        Route::get('/adicionar/{idEventos}', ['as' => 'adicionar', 'uses' => 'AtividadesController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'AtividadesController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'AtividadesController@postSalvar']);
        Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'AtividadesController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'AtividadesController@postExcluir']);
        Route::get('/view/{id}', ['as' => 'view', 'uses' => 'AtividadesController@getView']);
        /* Rotas para Responsável da Atividade*/
        Route::get('/adicionarResponsavel/{idAtividade}/{quantidadeResponsaveis}', ['as' => 'adicionarResponsavel', 'uses' => 'AtividadesResponsaveisController@getAdicionar']);
        Route::post('/salvarResponsavel', ['as' => 'salvarResponsavel', 'uses' => 'AtividadesResponsaveisController@postSalvarResponsavel']);
        Route::get('/editarResponsavel/{id}', ['as' => 'editarResponsavel', 'uses' => 'AtividadesResponsaveisController@editarResponsavel']);
        Route::patch('/atualizarResponsavel/{id}', ['as' => 'atualizarResponsavel', 'uses' => 'AtividadesResponsaveisController@atualizarResponsavel']);
        Route::post('/excluirResponsavel/{id}', ['as' => 'excluirResponsavel', 'uses' => 'AtividadesResponsaveisController@excluirResponsavel']);


        /* Rotas para Datas e Horários da Atividade*/
        Route::get('/adicionarDataHora/{idAtividade}', ['as' => 'adicionarDataHora', 'uses' => 'AtividadesDatasHorasController@getAdicionar']);
        Route::post('/salvarDataHora', ['as' => 'salvarDataHora', 'uses' => 'AtividadesDatasHorasController@postSalvarDataHora']);
        Route::get('/editarDataHora/{id}', ['as' => 'editarDataHora', 'uses' => 'AtividadesDatasHorasController@editarDataHora']);
        Route::patch('/atualizarDataHora/{id}', ['as' => 'atualizarDataHora', 'uses' => 'AtividadesDatasHorasController@atualizarDataHora']);
        Route::post('/excluirDataHora/{id}', ['as' => 'excluirDataHora', 'uses' => 'AtividadesDatasHorasController@excluirDataHora']);

        Route::post('/analisar/{id}', ['as' => 'analisar', 'uses' => 'AtividadesController@analisar']);
    });

    Route::group(['prefix' => 'contatos/', 'as' => 'contatos::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'EventosContatosController@getIndex']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EventosContatosController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosContatosController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EventosContatosController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosContatosController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosContatosController@postExcluir']);
    });

    Route::group(['prefix' => 'usuariosTipos/', 'as' => 'usuariosTipos::',], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UsuariosTiposController@getIndex',]);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'UsuariosTiposController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'UsuariosTiposController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'UsuariosTiposController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'UsuariosTiposController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'UsuariosTiposController@postExcluir']);
    });

    Route::group(['prefix' => 'eventos/', 'as' => 'eventos::',], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'EventosController@getIndex',]);
        Route::get('/visualizar/{id}', ['as' => 'visualizar', 'uses' => 'EventosController@getVisualizar']);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EventosController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EventosController@postSalvar']);
        Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosController@patchAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosController@postExcluir']);
        Route::get('/subeventos', ['as' => 'paginacaoSubeventos', 'uses' => 'EventosController@getSubeventos']);
        Route::post('/salvarLinkExterno', ['as' => 'salvarLinkExterno', 'uses' => 'EventosController@salvarLinkExterno']);

        Route::group(['prefix' => '{idPai?}'], function ($idPai = 0) {
            Route::get('/adicionar', ['as' => 'adicionarSubevento', 'uses' => 'EventosController@getAdicionar']);
            Route::post('/salvar', ['as' => 'salvarSubevento', 'uses' => 'EventosController@postSalvar']);
        });
    });
});
//Route::auth();

Route::get('/dashboard', 'HomeController@index');

Route::get('/geralzaum', function () {
    return view('/eventos/eventoGeral');
});

Route::get('/geralzaum2', function () {
    return view('/eventos/eventoGeral');
});
//
//Route::get('/novoEvento', function () {
//    return view('eventos.eventoMaster');
//});
//
//Route::get('/novoEvento2', function () {
//    return view('eventos.eventos');
//});
//
//Route::get('/novoEvento3', function () {
//    return view('eventos.eventosFinalizados');
//});
//
//Route::get('/novoCadastro', function () {
//    return view('cadastro');
//});