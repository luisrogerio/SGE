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

Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/cadastro', 'Auth\AuthController@getCadastro');
Route::get('/cadastroExterno', 'Auth\AuthController@getCadastroExterno');
Route::post('/salvarExterno', 'Auth\AuthController@postSalvarExterno');



// Password Reset Routes...
Route::get('reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('reset', 'Auth\PasswordController@reset');

Route::controller('/locais','LocaisController');

Route::controller('/atividadesTipos','AtividadesTiposController');

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

//Route::controller('/usuariosTipos','UsuariosTiposController');

Route::group([ 'prefix' => 'usuariosTipos/', 'as' => 'usuariosTipos::', ], function () {
    Route::get('/', [ 'as' => 'index', 'uses' => 'UsuariosTiposController@getIndex', ]);
    Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'UsuariosTiposController@getAdicionar']);
    Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'UsuariosTiposController@getEditar']);
    Route::post('/salvar', ['as' => 'salvar', 'uses' => 'UsuariosTiposController@postSalvar']);
    Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'UsuariosTiposController@postAtualizar']);
    Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'UsuariosTiposController@postExcluir']);

    Route::group([ 'prefix' => '{idUsuarioTipo}'], function ($idUsuarioTipo){
        Route::get('/adicionarConexao', ['as' => 'adicionarConexao', 'uses' => 'ConexoesExternasController@getAdicionar']);
        Route::post('/salvarConexao', ['as' => 'salvarConexao', 'uses' => 'ConexoesExternasController@postSalvar']);
        Route::get('/editarConexao/{id}', ['as' => 'editarConexao', 'uses' => 'ConexoesExternasController@getEditar']);
        Route::post('/atualizarConexao/{id}', ['as' => 'atualizarConexao', 'uses' => 'ConexoesExternasController@postAtualizar']);
        Route::post('/excluirConexao/{id}', ['as' => 'excluirConexao', 'uses' => 'ConexoesExternasController@postExcluir']);
    });
});

Route::group([ 'prefix' => 'eventos/', 'as' => 'eventos::', ], function () {

    Route::get('/', [ 'as' => 'index', 'uses' => 'EventosController@getIndex', ]);
    Route::get('/visualizar/{id}', ['as' => 'visualizar', 'uses' => 'EventosController@getVisualizar']);
    Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EventosController@getAdicionar']);
    Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosController@getEditar']);
    Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EventosController@postSalvar']);
    Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosController@patchAtualizar']);
    Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosController@postExcluir']);
    Route::get('/subeventos', ['as' => 'paginacaoSubeventos', 'uses' => 'EventosController@getSubeventos']);

    Route::group([ 'prefix' => '{idPai?}'], function ($idPai = 0){
        Route::get('/adicionar', ['as' => 'adicionarSubevento', 'uses' => 'EventosController@getAdicionar']);
        Route::post('/salvar', ['as' => 'salvarSubevento', 'uses' => 'EventosController@postSalvar']);
    });
});
//Route::auth();

Route::get('/dashboard', 'HomeController@index');
