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

//Route::get('/composer', function () {
//    Artisan::call('migrate', ['--force' => true]);
//    dd(Artisan::output());
//});

Route::get('/composer', function () {
    Artisan::call('cache:clear');
    dd(Artisan::output());
});

Route::group(['as' => 'auth::'], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/login', ['as' => 'logar', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('/cadastro', ['as' => 'cadastro', 'uses' => 'Auth\AuthController@getCadastro']);
    Route::post('/salvarExterno', ['as' => 'salvar', 'uses' => 'Auth\AuthController@postSalvarExterno']);
    Route::post('/password/reset', ['as' => 'reset', 'uses' => 'Auth\PasswordController@reset']);
    Route::post('/email', ['as' => 'email', 'uses' => 'Auth\PasswordController@postEmail']);
    Route::post('/alterarSenha', ['as' => 'passwordChange', 'uses' => 'Auth\AuthController@alterarSenha']);
});

Route::get('/password/reset/{token?}', ['as' => 'resetToken', 'uses' => 'Auth\PasswordController@showResetForm']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);
    Route::get('/perfil', ['as' => 'perfil', 'uses' => 'HomeController@perfil']);
    Route::get('/editarPerfil', ['as' => 'editarPerfil', 'uses' => 'HomeController@getEditarPerfil']);
    Route::patch('/atualizarPerfil', ['as' => 'atualizarPerfil', 'uses' => 'HomeController@patchAtualizarPerfil']);
});

Route::get('/propostas/iv-simepe', function () {
    return view('publico.atividades.propostasFinalizadas');
});

//Route::get('/propostas/{nomeEvento}', ['as' => 'adicionarAtividadePublico', 'uses' => 'AtividadesController@getAdicionarPublico']);
//Route::post('/salvarProposta', ['as' => 'salvarAtividadePublico', 'uses' => 'AtividadesController@postSalvarPublico']);
//Route::get('/adicionarResponsavel/{idAtividade}/{quantidadeResponsaveis}', ['as' => 'adicionarResponsavelPublico', 'uses' => 'AtividadesResponsaveisController@getAdicionarPublico']);
//Route::post('/salvarResponsavel', ['as' => 'salvarResponsavelPublico', 'uses' => 'AtividadesResponsaveisController@postSalvarResponsavelPublico']);

Route::group(['prefix' => 'eventos/', 'as' => 'eventosPublico::'], function () {
    Route::get('/{query?}', ['as' => 'index', 'uses' => 'EventosController@getIndexPublico']);
});

Route::group(['prefix' => 'certificados/'], function () {
    Route::get('/autenticar/{codigo}', ['uses' => 'EventosController@getAutenticarCertificado']);
});

Route::group(['prefix' => 'evento/', 'as' => 'eventosPublico::'], function () {
    Route::get('/atividades/{nomeSlug}', ['as' => 'atividadesEvento', 'uses' => 'EventosController@getAtividadesPublico']);
    Route::post('/atividade/{id}', ['as' => 'atividade', 'uses' => 'AtividadesController@getAtividade']);
    Route::get('/{nomeSlug}', ['as' => 'visualizar', 'uses' => 'EventosController@getVisualizarPublico']);
    Route::get('/minhaAgenda/{nomeSlug}', ['as' => 'minhaAgenda', 'uses' => 'EventosController@getMinhaAgenda', 'middleware' => 'auth']);
    Route::get('/certificados/{nomeSlug}', ['as' => 'certificados', 'uses' => 'EventosController@getVisualizarCertificados', 'middleware' => 'auth']);
    Route::get('/galeria/{nomeSlug}', ['as' => 'galeria', 'uses' => 'EventosController@getVisualizarGaleria']);
    Route::get('/avisos/{nomeSlug}', ['as' => 'avisos', 'uses' => 'EventosController@getVisualizarAvisos']);
    Route::post('/participar/{nomeSlug}', ['as' => 'participar', 'uses' => 'EventosController@getParticiparEvento', 'middleware' => 'auth']);
    Route::get('/participarAtividade/{id}', ['as' => 'participarAtividade', 'uses' => 'AtividadesController@participarAtividade', 'middleware' => 'auth']);
    Route::get('/revogarParticipacaoAtividade/{id}', ['as' => 'revogarParticipacaoAtividade', 'uses' => 'AtividadesController@revovarParticipacaoAtividade', 'middleware' => 'auth']);
});


Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'roles:admin']], function () {

    Route::get('/', ['as' => 'admin::index', 'uses' => 'HomeController@indexAdmin']);

    Route::group(['prefix' => 'espacosTipos/', 'as' => 'espacosTipos::',], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'EspacosTiposController@getIndex',]);
        Route::get('/adicionar', ['as' => 'adicionar', 'uses' => 'EspacosTiposController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EspacosTiposController@getEditar']);
        Route::post('/salvar', ['as' => 'salvar', 'uses' => 'EspacosTiposController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EspacosTiposController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EspacosTiposController@postExcluir']);
    });

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
        Route::patch('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'LocaisController@postAtualizar']);
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
        /* Links Externos */
        Route::post('/salvarLinkExterno', ['as' => 'salvarLinkExterno', 'uses' => 'EventosController@salvarLinkExterno']);
        Route::post('/removerLinkExterno/{idLink}', ['as' => 'removerLinkExterno', 'uses' => 'EventosController@removerLinkExterno']);

        /* Fins de Evento */
        Route::get('/credenciamento/{nomeSlug}', ['as' => 'credenciamento', 'uses' => 'EventosController@getCredenciamento']);
        Route::get('/relatoriosAtividade/{nomeSlug}', ['as' => 'relatoriosAtividade', 'uses' => 'EventosController@getRelatorioAtividades']);
        Route::get('/listasDePresencas/{nomeSlug}', ['as' => 'listasDePresencas', 'uses' => 'EventosController@getListasDePresencas']);
        Route::get('/listaDePresenca/{id}', ['as' => 'listaDePresenca', 'uses' => 'EventosController@getListaDePresenca']);
        Route::get('/lancamentoDePresenca/{id}', ['as' => 'lancamentoDePresenca', 'uses' => 'EventosController@getLancamentoDePresenca']);
        Route::get('/lancamentoDePresencaExtra/{id}', ['as' => 'lancamentoDePresencaExtra', 'uses' => 'EventosController@getLancamentoDePresencaExtra']);
        Route::get('/lancamentoDePresencaTrabalhos/{id}', ['as' => 'lancamentoDePresencaTrabalhos', 'uses' => 'EventosController@getLancamentoDePresencaTrabalhos']);
        Route::get('/lancamentoDePresencaTrabalho/{id}', ['as' => 'lancamentoDePresencaTrabalho', 'uses' => 'EventosController@getLancamentoDePresencaTrabalho']);
        Route::get('/lancamentoDePresencaEvento/{id}', ['as' => 'lancamentoDePresencaEvento', 'uses' => 'EventosController@getLancamentoDePresencaEvento']);
        Route::post('/lancarPresenca/{id}', ['as' => 'lancarPresenca', 'uses' => 'EventosController@getLancarPresenca']);
        Route::post('/lancarPresencaExtra/{id}/{idParticipante}', ['as' => 'lancarPresencaExtra', 'uses' => 'EventosController@getLancarPresencaExtra']);
        Route::post('/lancarPresencaEvento/{id}', ['as' => 'lancarPresencaEvento', 'uses' => 'EventosController@getLancarPresencaEvento']);
        Route::post('/lancarPresencaTrabalhos/{id}', [ 'as' => 'lancarPresencaTrabalhos', 'uses' => 'EventosController@getLancarPresencaTrabalhos']);

        /* Certificados */
        Route::post('/certificarEvento/{nomeSlug}', ['as' => 'certificarEvento', 'uses' => 'EventosController@getCertificarEvento']);
        Route::post('/certificarAtividade/{id}', ['as' => 'certificarAtividade', 'uses' => 'EventosController@getCertificarAtividade']);
        Route::post('/certificarAutor/{id}', ['as' => 'certificarAutor', 'uses' => 'EventosController@getCertificarAutor']);
        Route::post('/certificarBanner/{id}', ['as' => 'certificarBanner', 'uses' => 'EventosController@getCertificarBanner']);
        Route::post('/certificarOral/{id}', ['as' => 'certificarOral', 'uses' => 'EventosController@getCertificarOral']);
        Route::post('/certificarRevisor/{id}', ['as' => 'certificarRevisor', 'uses' => 'EventosController@getCertificarRevisor']);
        Route::get('/certificarMinistrantes/{id}', ['as' => 'certificarMinistrantes', 'uses' => 'EventosController@getCertificarMinistrantes']);

        Route::group(['prefix' => '{idPai?}'], function ($idPai = 0) {
            Route::get('/adicionar', ['as' => 'adicionarSubevento', 'uses' => 'EventosController@getAdicionar']);
            Route::post('/salvar', ['as' => 'salvarSubevento', 'uses' => 'EventosController@postSalvar']);
        });
    });

    Route::group(['prefix' => 'eventosNoticias/', 'as' => 'eventosNoticias::'], function () {
        Route::get('/{idEventos}', ['as' => 'index', 'uses' => 'EventosNoticiasController@getIndex']);
        Route::get('/adicionar/{idEventos}', ['as' => 'adicionar', 'uses' => 'EventosNoticiasController@getAdicionar']);
        Route::get('/editar/{id}', ['as' => 'editar', 'uses' => 'EventosNoticiasController@getEditar']);
        Route::post('/salvar/{idEventos}', ['as' => 'salvar', 'uses' => 'EventosNoticiasController@postSalvar']);
        Route::post('/atualizar/{id}', ['as' => 'atualizar', 'uses' => 'EventosNoticiasController@postAtualizar']);
        Route::post('/excluir/{id}', ['as' => 'excluir', 'uses' => 'EventosNoticiasController@postExcluir']);
    });
});
