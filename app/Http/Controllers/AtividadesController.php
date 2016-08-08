<?php

namespace SGE\Http\Controllers;

use SGE\Models\AtividadeTipo;
use SGE\Models\Local;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use SGE\Models\Atividade;
use SGE\Http\Requests\AtividadesRequest;
use SGE\Http\Requests;
use SGE\Models\Curso;

class AtividadesController extends Controller
{
    private $atividade;

    public function __construct(Atividade $atividade){
        $this->atividade = $atividade;
    }

    public function getIndex(){
        $atividades = $this->atividade->orderBy('nome')->paginate(5);
        return view('atividades.index', compact('atividades'));
    }

    public function getAdicionar(){
        $cursos             = Curso::get()->lists('sigla', 'id');
        $atividadesTipos    = AtividadeTipo::get()->lists('nome', 'id');
        $locais             = Local::get()->lists('nome', 'id');
        return view('atividades.adicionar', compact('cursos', 'atividadesTipos', 'locais'));
    }

    public function postSalvar(AtividadesRequest $request){
        $this->atividade->fill($request->all());
        if ($this->atividade->save()) {
            return redirect('/atividades');
        }
    }

    public function getEditar($id){
        $atividade = $this->atividade->findOrFail($id);
        $cursos = Curso::all();
        return view('atividades.editar', compact('atividade', 'cursos'));
    }

    public function postAtualizar(AtividadesRequest $request, $id){
        $this->atividade = $this->atividade->findOrFail($id);
        $this->atividade->fill($request->all());
        if ($this->atividade->update()) {
            \Session::flash('message', 'Atividade atualizado com sucesso');
            return redirect('/atividades');
        }
    }

    public function postExcluir($id){
        $atividade = $this->atividade->findOrFail($id);
        $atividade->delete();
        \Session::flash('message', 'Atividade excluído com sucesso');
        return redirect('/atividades');
    }
}
