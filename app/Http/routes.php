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

Route::controller('/eventos', 'EventosController');

Route::controller('/contatos', 'EventosContatosController');

//Route::controller('/testes', 'TestesController');

Route::get('testes',function(){return view('testes.teste');});

Route::post('/getmsg','TestesController@index');

Route::get('popup', function()
{
    dd('agora está indo');
    $atividadesTipos = curso::get()->lists('id', 'nome');
    return Response::json($atividadesTipos->get(array('id','nome')));
});