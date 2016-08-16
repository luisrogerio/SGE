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

Route::get('/', function () {
    return view('welcome');
});

Route::controller('/locais','LocaisController');

Route::controller('/atividadesTipos','AtividadesTiposController');

Route::controller('/usuariosTipos','UsuariosTiposController');

Route::controller('/cursos', 'CursosController');

Route::controller('/statusdeatividade', 'AtividadesStatusConroller');

Route::controller('/gruposdeusuario', 'UsuariosGruposController');

Route::controller('/atividades', 'AtividadesController');

//Route::controller('/eventos', 'EventosController');

Route::controller('/contatos', 'EventosContatosController');

Route::controller('/testes', 'TestesController');

//Route::group(['prefix' => '/evento/{$idEvento}'], function () {
//    Route::get('/adicionar', ['uses' => 'EventosController@getAdicionar']);
//    Route::post('/salvar', 'EventosController@patchAtualizar');
//});

Route::group([ 'prefix' => 'eventos/', 'as' => 'eventos::', ], function () {

    Route::get('/', [ 'as' => 'index', 'uses' => 'EventosController@getIndex', ]);
    Route::get('/visualizar/{id}', ['as' => 'visualizar', 'uses' => 'EventosController@getVisualizar']);
    Route::group([ 'prefix' => '{idPai?}'], function ($idPai = 0){
        Route::get('/adicionar', ['as' => 'adicionarSubevento', 'uses' => 'EventosController@getAdicionar']);
        Route::post('/salvar', ['as' => 'salvarSubevento', 'uses' => 'EventosController@postSalvar']);
    });
    Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EventosController@getAdicionar']);
    Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosController@getEditar']);
    Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EventosController@postSalvar']);
    Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosController@patchAtualizar']);
    Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosController@postExcluir']);
    Route::get('/subeventos', ['as' => 'paginacaoSubeventos', 'uses' => 'EventosController@getSubeventos']);
});