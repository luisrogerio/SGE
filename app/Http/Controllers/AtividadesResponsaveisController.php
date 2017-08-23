<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtividadeResponsavelRequest;
use App\Models\Atividade;
use App\Models\AtividadeResponsavel;
use Illuminate\Http\Request;


class AtividadesResponsaveisController extends Controller
{
    private $atividadeResponsavel;

    public function __construct(AtividadeResponsavel $atividadeResponsavel)
    {
        $this->atividadeResponsavel = $atividadeResponsavel;
    }

    public function getAdicionar($idAtividade, $quantidadeResponsaveis)
    {
        return view('atividadesResponsaveis.adicionar', [
            'idAtividade' => $idAtividade,
            'quantidadeResponsaveis' => $quantidadeResponsaveis
        ]);
    }

    public function postSalvarResponsavel(AtividadeResponsavelRequest $request)
    {
        $atividade = Atividade::findOrFail($request->idAtividade);

        foreach($request->salvar as $key => $value){
            if($value){
                $atividadeResponsavel = [
                    'nome' => $request->input('nome.'.$key),
                    'titulacao' => $request->input('titulacao.'.$key),
                    'instituicaoOrigem' => $request->input('instituicaoOrigem.'.$key),
                    'experienciaProfissional' => $request->input('experienciaProfissional.'.$key)
                ];
                $atividade->atividadesResponsaveis()->create($atividadeResponsavel);
            }
        }
        return redirect()->route('atividades::index', ['idEventos' => $atividade->evento->id]);
    }

    public function editarResponsavel($id)
    {
        $atividadeResponsavel = AtividadeResponsavel::findOrFail($id);
        return view('atividadesResponsaveis.editar', compact('atividadeResponsavel'));
    }

    public function atualizarResponsavel(AtividadeResponsavelRequest $request, $id)
    {
        $atividadeResponsavel = AtividadeResponsavel::findOrFail($id);
        $atividadeResponsavel->fill($request->all());
        if ($atividadeResponsavel->save()) {
            \Session::flash('message', 'Responsável atualizado com sucesso');
        } else {
            \Session::flash('message', 'House um problema ao tentar atualizar o responsável');
        }
        return redirect()->route('atividades::view', ['id' => $atividadeResponsavel->atividade->id]);
    }

    public function excluirResponsavel($id)
    {
        $atividadeResponsavel = AtividadeResponsavel::findOrFail($id);
        $idAtividade = $atividadeResponsavel->atividade->id;
        if ($atividadeResponsavel->delete()) {
            \Session::flash('message', 'Responsável removido com sucesso');
            return redirect()->route('atividades::view', ['id' => $idAtividade]);
        }
    }
}
