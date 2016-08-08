<?php

namespace SGE\Http\Controllers;

use Illuminate\Http\Request;

use SGE\Http\Requests;
use SGE\Models\UsuarioGrupo;
use SGE\Http\Requests\UsuariosGruposRequest;

class UsuariosGruposController extends Controller{
    private $usuarioGrupo;

    public function __construct(UsuarioGrupo $usuarioGrupo){
        $this->usuarioGrupo = $usuarioGrupo;
    }

    public function getIndex(){
        $usuariosGrupos = UsuarioGrupo::orderBy('nome')->paginate(5);
        return view('usuariosGrupos.index',compact('usuariosGrupos'));
    }

    public function getAdicionar(){
        return view('usuariosGrupos.adicionar');
    }

    public function postSalvar(UsuariosGruposRequest $request){
        $this->usuarioGrupo->fill($request->all());
        if ($this->usuarioGrupo->save()) {
            return redirect('/gruposdeusuario');
        }
    }

    public function getEditar($id){
        $usuarioGrupo = $this->usuarioGrupo->findOrFail($id);
        return view('usuariosGrupos.editar', compact('usuarioGrupo'));
    }

    public function postAtualizar(UsuariosGruposRequest $request, $id){
        $this->usuarioGrupo = $this->usuarioGrupo->findOrFail($id);
        $this->usuarioGrupo->fill($request->all());
        if ($this->usuarioGrupo->update()) {
            \Session::flash('message', 'Grupo de Usuário atualizado com sucesso');
            return redirect('/gruposdeusuario');
        }
    }

    public function postExcluir($id){
        $usuarioGrupo = $this->usuarioGrupo->findOrFail($id);
        $usuarioGrupo->delete();
        \Session::flash('message', 'Grupo de Usuário excluído com sucesso');
        return redirect('/gruposdeusuario');
    }
}
