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

Route::group([ 'prefix' => 'locais/', 'as' => 'locais::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'LocaisController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'LocaisController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'LocaisController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'LocaisController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'LocaisController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'LocaisController@postExcluir']);

});

Route::group([ 'prefix' => 'atividadesTipos/', 'as' => 'atividadesTipos::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'AtividadesTiposController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'AtividadesTiposController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'AtividadesTiposController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'AtividadesTiposController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'AtividadesTiposController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'AtividadesTiposController@postExcluir']);

});

Route::group([ 'prefix' => 'cursos/', 'as' => 'cursos::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'CursosController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'CursosController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'CursosController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'CursosController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'CursosController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'CursosController@postExcluir']);

});

Route::group([ 'prefix' => 'statusdeatividade/', 'as' => 'statusdeatividade::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'AtividadesStatusConroller@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'AtividadesStatusConroller@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'AtividadesStatusConroller@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'AtividadesStatusConroller@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'AtividadesStatusConroller@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'AtividadesStatusConroller@postExcluir']);

});

Route::group([ 'prefix' => 'gruposdeusuario/', 'as' => 'gruposdeusuario::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'UsuariosGruposController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'UsuariosGruposController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'UsuariosGruposController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'UsuariosGruposController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'UsuariosGruposController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'UsuariosGruposController@postExcluir']);

});

Route::group([ 'prefix' => 'atividades/', 'as' => 'atividades::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'AtividadesController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'AtividadesController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'AtividadesController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'AtividadesController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'AtividadesController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'AtividadesController@postExcluir']);

});

Route::group([ 'prefix' => 'contatos/', 'as' => 'contatos::'], function() {
    Route::get('/', [ 'as' => 'index', 'uses' => 'EventosContatosController@getIndex']);
    Route::get('/adicionar', [ 'as' => 'adicionar', 'uses' => 'EventosContatosController@getAdicionar']);
    Route::get('/edital/{id}', [ 'as' => 'editar', 'uses' => 'EventosContatosController@getEditar']);
    Route::post('/salvar', [ 'as' => 'salvar', 'uses' => 'EventosContatosController@postSalvar']);
    Route::post('/atualizar/{id}', [ 'as' => 'atualizar', 'uses' => 'EventosContatosController@postAtualizar']);
    Route::post('/excluir/{id}', [ 'as' => 'excluir', 'uses' => 'EventosContatosController@postExcluir']);

});

//Route::controller('/testes', 'TestesController');

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

//    Route::group([ 'prefix' => '{idUsuarioTipo}'], function ($idUsuarioTipo){
//        Route::get('/adicionarConexao', ['as' => 'adicionarConexao', 'uses' => 'ConexoesExternasController@getAdicionar']);
//        Route::post('/salvarConexao', ['as' => 'salvarConexao', 'uses' => 'ConexoesExternasController@postSalvar']);
//        Route::get('/editarConexao/{id}', ['as' => 'editarConexao', 'uses' => 'ConexoesExternasController@getEditar']);
//        Route::post('/atualizarConexao/{id}', ['as' => 'atualizarConexao', 'uses' => 'ConexoesExternasController@postAtualizar']);
//        Route::post('/excluirConexao/{id}', ['as' => 'excluirConexao', 'uses' => 'ConexoesExternasController@postExcluir']);
//    });
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
