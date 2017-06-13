<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtividadeTipo;
use App\Http\Requests\AtividadesTiposRequest;
use App\Http\Requests;

class AtividadesTiposController extends Controller
{
    private $atividadeTipo;

    public function __construct(AtividadeTipo $atividadeTipo)
    {
        $this->atividadeTipo = $atividadeTipo;
    }

    public function getIndex()
    {
        $atividadesTipos = AtividadeTipo::orderBy('nome')->paginate(5);
        return view('atividadesTipos.index', compact('atividadesTipos'));
    }

    public function getAdicionar()
    {
        return view('atividadesTipos.adicionar');
    }

    public function postSalvar(AtividadesTiposRequest $request)
    {
        $this->atividadeTipo->fill($request->all());
        if ($this->atividadeTipo->save()) {
            return redirect('/atividadesTipos');
        }
    }

    public function getEditar($id)
    {
        $atividadeTipo = $this->atividadeTipo->findOrFail($id);
        return view('atividadesTipos.editar', compact('atividadeTipo'));
    }

    public function postAtualizar(AtividadesTiposRequest $request, $id)
    {
        $this->atividadeTipo = $this->atividadeTipo->findOrFail($id);
        $this->atividadeTipo->fill($request->all());
        if ($this->atividadeTipo->update()) {
            \Session::flash('message', 'Tipo de atividade atualizado com sucesso');
            return redirect('/atividadesTipos');
        }
    }

    public function postExcluir($id)
    {
        $atividadeTipo = $this->atividadeTipo->findOrFail($id);
        $atividadeTipo->delete();
        \Session::flash('message', 'Tipo de atividade excluído com sucesso');
        return redirect('/atividadesTipos');
    }
}
