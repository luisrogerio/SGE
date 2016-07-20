<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Http\Requests\LocaisRequest;
use App\Http\Requests;

class LocaisController extends Controller
{
    private $local;
    public function __construct(Local $local){
        $this->local = $local;
    }

    public function getIndex(){
        $locais = Local::orderBy('nome')->paginate(5);
        return view('locais.index',compact('locais'));
    }

    public function getAdicionar(){
        return view('locais.adicionar');
    }

    public function postSalvar(LocaisRequest $request){
        $this->local->fill($request->all());
        if ($this->local->save()) {
            return redirect('/locais');
        }
    }

    public function getEditar($id){
        $local = $this->local->findOrFail($id);
        return view('locais.editar', compact('local'));
    }

    public function postAtualizar(LocaisRequest $request, $id){
        $this->local = $this->local->findOrFail($id);
        $this->local->fill($request->all());
        if ($this->local->update()) {
            \Session::flash('message', 'Local atualizado com sucesso');
            return redirect('/locais');
        }
    }

    public function postExcluir($id){
        $local = $this->local->findOrFail($id);
        $local->delete();
        \Session::flash('message', 'Local excluído com sucesso');
        return redirect('/locais');
    }
}
