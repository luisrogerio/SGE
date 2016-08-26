<?php

namespace App\Http\Controllers;

use App\Models\ConexaoExterna;
use App\Models\UsuarioTipo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ConexoesExternasRequest;

class ConexoesExternasController extends Controller
{
    private $conexaoExterna;
    public function __construct(ConexaoExterna $conexaoExterna){
        $this->conexaoExterna = $conexaoExterna;
    }

    public function getAdicionar($idUsuarioTipo){
        $usuarioTipo = UsuarioTipo::findOrFail($idUsuarioTipo);
        return view('conexoesExternas.adicionar', compact('usuarioTipo'));
    }

    public function postSalvar(ConexoesExternasRequest $request, $idUsuarioTipo){
        $usuarioTipo = UsuarioTipo::findOrFail($idUsuarioTipo);
        $this->conexaoExterna->fill($request->all());
        if ($usuarioTipo->conexaoExterna()->save($this->conexaoExterna)) {
            \Session::flash('message', 'Conexão Externa salva com sucesso');
            return redirect('/usuariosTipos');
        }
    }

    public function getEditar($idUsuarioTipo, $id){
        $usuarioTipo = UsuarioTipo::findOrFail($idUsuarioTipo);
        $conexaoExterna = $this->conexaoExterna->findOrFail($id);
        return view('conexoesExternas.editar', compact('conexaoExterna', 'usuarioTipo'));
    }

    public function postAtualizar(ConexoesExternasRequest $request, $idUsuarioTipo, $id){
        $usuarioTipo = UsuarioTipo::findOrFail($idUsuarioTipo);
        $this->conexaoExterna = $this->conexaoExterna->findOrFail($id);
        $this->conexaoExterna->fill($request->all());
        if ($this->conexaoExterna->update()) {
            \Session::flash('message', 'Conexão Externa atualizada com sucesso');
            return redirect('/usuariosTipos');
        }
    }

    public function postExcluir($idUsuarioTipo, $id){
        $usuarioTipo = UsuarioTipo::findOrFail($idUsuarioTipo);
        $this->conexaoExterna = $this->conexaoExterna->findOrFail($id);
        $this->conexaoExterna->usuarioTipo()->dissociate();
        if($this->conexaoExterna->delete()){
            \Session::flash('message', 'Conexão Externa excluída com sucesso');
            return redirect('/usuariosTipos');
        }
    }
    
}
