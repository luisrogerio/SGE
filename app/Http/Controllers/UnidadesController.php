<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadesRequest;
use App\Models\Unidade;

class UnidadesController extends Controller
{
    private $unidade;
    public function __construct(Unidade $unidade){
        $this->unidade = $unidade;
    }

    public function getIndex(){
        $unidades = Unidade::orderBy('nome')->paginate(5);
        return view('unidades.index',compact('unidades'));
    }

    public function getAdicionar(){
        return view('unidades.adicionar');
    }

    public function postSalvar(UnidadesRequest $request){
        $this->unidade->fill($request->all());
        if ($this->unidade->save()) {
            return redirect('/unidades');
        }
    }

    public function getEditar($id){
        $unidade = $this->unidade->findOrFail($id);
        return view('unidades.editar', compact('unidade'));
    }

    public function postAtualizar(UnidadesRequest $request, $id){
        $this->unidade = $this->unidade->findOrFail($id);
        $this->unidade->fill($request->all());
        if ($this->unidade->update()) {
            \Session::flash('message', 'Unidade atualizada com sucesso');
            return redirect('/unidades');
        }
    }

    public function postExcluir($id){
        $unidade = $this->unidade->findOrFail($id);
        $unidade->delete();
        \Session::flash('message', 'Unidade excluída com sucesso');
        return redirect('/unidades');
    }
}
