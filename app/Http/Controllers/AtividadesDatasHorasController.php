<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtividadeDataHoraRequest;
use App\Models\AtividadeDataHora;
use App\Models\Atividade;
use Carbon\Carbon;

class AtividadesDatasHorasController extends Controller
{
    private $atividadeDataHora;

    public function __construct(AtividadeDataHora $atividadeDataHora)
    {
        $this->atividadeDataHora = $atividadeDataHora;
    }

    public function getAdicionar($idAtividade)
    {
        $atividade = Atividade::findOrFail($idAtividade);
        return view('atividadesDatasHoras.adicionar', [
            'atividade' => $atividade
        ]);
    }

    public function postSalvarDataHora(AtividadeDataHoraRequest $request)
    {
        $atividade = Atividade::findOrFail($request->idAtividade);

        $atividade->atividadesDatasHoras()->create(array(
            'data' => Carbon::createFromFormat('d/m/Y', $request->input('data')),
            'horarioInicio' => $request->horarioInicio,
            'horarioTermino' => $request->horarioTermino
        ));
        return redirect()->route('atividades::view', ['id' => $atividade->id]);
    }

    public function editarDataHora($id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        return view('atividadesDatasHoras.editar', compact('atividadeDataHora'));
    }

    public function atualizarDataHora(AtividadeDataHoraRequest $request, $id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        $request->merge(array('data' => Carbon::createFromFormat('d/m/Y', $request->input('data'))));
        $atividadeDataHora->fill($request->all());
        if ($atividadeDataHora->save()) {
            \Session::flash('message', 'Data e Horário atualizados com sucesso');
        } else {
            \Session::flash('message', 'House um problema ao tentar atualizar a data e horário');
        }
        return redirect()->route('atividades::view', ['id' => $atividadeDataHora->atividade->id]);
    }

    public function excluirDataHora($id)
    {
        $atividadeDataHora = AtividadeDataHora::findOrFail($id);
        $idAtividade = $atividadeDataHora->atividade->id;
        if ($atividadeDataHora->delete()) {
            \Session::flash('message', 'Data e horário removidos com sucesso');
            return redirect()->route('atividades::view', ['id' => $idAtividade]);
        }
    }
}
