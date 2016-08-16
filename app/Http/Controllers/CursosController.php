<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Curso;
use App\Http\Requests\CursosRequest;

class CursosController extends Controller{
    private $curso;

    public function __construct(Curso $curso){
        $this->curso = $curso;
    }

    public function getIndex(){
        $cursos = $this->curso->orderBy('nome')->paginate(5);
        return view('cursos.index', compact('cursos'));
    }

    public function getAdicionar(){
        return view('cursos.adicionar');
    }

    public function postSalvar(CursosRequest $request){
        $this->curso->fill($request->all());
        if ($this->curso->save()) {
            return redirect('/cursos');
        }
    }

    public function getEditar($id){
        $curso = $this->curso->findOrFail($id);
        return view('cursos.editar', compact('curso'));
    }

    public function postAtualizar(CursosRequest $request, $id){
        $this->curso = $this->curso->findOrFail($id);
        $this->curso->fill($request->all());
        if ($this->curso->update()) {
            \Session::flash('message', 'Curso atualizado com sucesso');
            return redirect('/cursos');
        }
    }

    public function postExcluir($id){
        $curso = $this->curso->findOrFail($id);
        $curso->delete();
        \Session::flash('message', 'Curso excluído com sucesso');
        return redirect('/cursos');
    }

    public function getPopup(CursosRequest $request){
        $this->curso->fill($request->all());
        if ($this->curso->save()) {
            return redirect('/cursos');
        }
//        $this->atividadeTipo->nome = $nome;
//        if ($this->atividadeTipo->save()) {
//            $atividadesTiposCombo = AtividadeTipo::orderBy('nome');
//            //return Response::json($atividadesTiposCombo->get(array('id','nome')));
//            return response()->json($atividadesTiposCombo->get(array('id','nome')));
//        }
    }
}
