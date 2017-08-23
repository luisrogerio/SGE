<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AtividadesDatasHorasController extends Controller
{
    private $atividadeDataHora;

    public function __construct(AtividadeDataHora $atividadeDataHora)
    {
        $this->atividadeDataHora = $atividadeDataHora;
    }

    public function getAdicionar($idAtividade)
    {
        return view('atividadesDatasHoras.adicionar', [
            'idAtividade' => $idAtividade
        ]);
    }

    public function postSalvarDataHora(AtividadeDataHoraRequest $request)
    {
        $atividade = Atividade::findOrFail($request->idAtividade);

        $this->atividadeDataHora->fill($request->all());
        $atividade->atividadesDatasHoras()->create($this->atividadeDataHora);
        return redirect()->route('atividades::visualizar', ['id' => $atividade->id]);
    }

    public function editarDataHora($id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        return view('atividadesDatasHoras.editar', compact('atividadeDataHora'));
    }

    public function atualizarDataHora(AtividadeDataHoraRequest $request, $id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        $atividadeDataHora->fill($request->all());
        if ($atividadeDataHora->save()) {
            \Session::flash('message', 'Responsável atualizado com sucesso');
        } else {
            \Session::flash('message', 'House um problema ao tentar atualizar o responsável');
        }
        return redirect()->route('atividades::view', ['id' => $atividadeDataHora->atividade->id]);
    }

    public function excluirDataHora($id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        $idAtividade = $atividadeDataHora->atividade->id;
        if ($atividadeDataHora->delete()) {
            \Session::flash('message', 'Responsável removido com sucesso');
            return redirect()->route('atividades::view', ['id' => $idAtividade]);
        }
    }
}
