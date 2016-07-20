<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioTipo;
use App\Http\Requests\UsuariosTiposRequest;
use App\Http\Requests;

class UsuariosTiposController extends Controller
{
    private $usuarioTipo;
    public function __construct(UsuarioTipo $usuarioTipo){
        $this->usuarioTipo = $usuarioTipo;
    }

    public function getIndex(){
        $usuariosTipos = UsuarioTipo::orderBy('nome')->paginate(5);
        return view('usuariosTipos.index',compact('usuariosTipos'));
    }

    public function getAdicionar(){
        return view('usuariosTipos.adicionar');
    }

    public function postSalvar(UsuariosTiposRequest $request){
        $this->usuarioTipo->fill($request->all());
        if ($this->usuarioTipo->save()) {
            return redirect('/usuariosTipos');
        }
    }

    public function getEditar($id){
        $usuarioTipo = $this->usuarioTipo->findOrFail($id);
        return view('usuariosTipos.editar', compact('usuarioTipo'));
    }

    public function postAtualizar(UsuariosTiposRequest $request, $id){
        $this->usuarioTipo = $this->usuarioTipo->findOrFail($id);
        $this->usuarioTipo->fill($request->all());
        if ($this->usuarioTipo->update()) {
            \Session::flash('message', 'Tipo de Usuário atualizado com sucesso');
            return redirect('/usuariosTipos');
        }
    }

    public function postExcluir($id){
        $usuarioTipo = $this->usuarioTipo->findOrFail($id);
        $usuarioTipo->delete();
        \Session::flash('message', 'Tipo de Usuário excluído com sucesso');
        return redirect('/usuariosTipos');
    }
}
