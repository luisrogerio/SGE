<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\AtividadeStatus;
use App\Http\Requests\AtividadesStatusRequest;

class AtividadesStatusConroller extends Controller
{
    private $atividadeStatus;
    public function __construct(AtividadeStatus $atividadeStatus){
        $this->atividadeStatus = $atividadeStatus;
    }

    public function getIndex(){
        $atividadesStatus = AtividadeStatus::orderBy('nome')->paginate(5);
        return view('atividadesStatus.index',compact('atividadesStatus'));
    }

    public function getAdicionar(){
        return view('atividadesStatus.adicionar');
    }

    public function postSalvar(AtividadesStatusRequest $request){
        $this->atividadeStatus->fill($request->all());
        if ($this->atividadeStatus->save()) {
            return redirect('/statusdeatividade');
        }
    }

    public function getEditar($id){
        $atividadeStatus = $this->atividadeStatus->findOrFail($id);
        return view('atividadesStatus.editar', compact('atividadeStatus'));
    }

    public function postAtualizar(AtividadesStatusRequest $request, $id){
        $this->atividadeStatus = $this->atividadeStatus->findOrFail($id);
        $this->atividadeStatus->fill($request->all());
        if ($this->atividadeStatus->update()) {
            \Session::flash('message', 'Status de Atividade atualizado com sucesso');
            return redirect('/statusdeatividade');
        }
    }

    public function postExcluir($id){
        $atividadeStatus = $this->atividadeStatus->findOrFail($id);
        $atividadeStatus->delete();
        \Session::flash('message', 'Status de Atividade excluído com sucesso');
        return redirect('/statusdeatividade');
    }
}
