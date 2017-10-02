<?php

namespace App\Http\Controllers;

use App\Models\EspacoTipo;
use App\Http\Requests\EspacosTiposRequest;


class EspacosTiposController extends Controller
{
    private $espacoTipo;

    public function __construct(EspacoTipo $espacoTipo)
    {
        $this->espacoTipo = $espacoTipo;
    }

    public function getIndex()
    {
        $espacosTipos = EspacoTipo::orderBy('nome')->paginate(5);
        return view('espacosTipos.index', compact('espacosTipos'));
    }

    public function getAdicionar()
    {
        return view('espacosTipos.adicionar');
    }

    public function postSalvar(EspacosTiposRequest $request)
    {
        $this->espacoTipo->fill($request->all());
        if ($this->espacoTipo->save()) {
            return redirect()->route('espacosTipos::index');
        }
    }

    public function getEditar($id)
    {
        $espacoTipo = $this->espacoTipo->findOrFail($id);
        return view('espacosTipos.editar', compact('espacoTipo'));
    }

    public function postAtualizar(EspacosTiposRequest $request, $id)
    {
        $this->espacoTipo = $this->espacoTipo->findOrFail($id);
        $this->espacoTipo->fill($request->all());
        if ($this->espacoTipo->update()) {
            \Session::flash('message', 'Tipo de Espaço atualizado com sucesso');
            return redirect()->route('espacosTipos::index');
        }
    }

    public function postExcluir($id)
    {
        $espacoTipo = $this->espacoTipo->findOrFail($id);
        $espacoTipo->delete();
        \Session::flash('message', 'Tipo de Espaço excluído com sucesso');
        return redirect()->route('espacosTipos::index');
    }
}
