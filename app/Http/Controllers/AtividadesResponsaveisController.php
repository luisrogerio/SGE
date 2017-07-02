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
        return redirect('/eventos/visualizar/'.$atividade->evento->id);
    }
}
