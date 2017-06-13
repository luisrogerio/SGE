<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
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

    public function getIndex($idUnidades){
        $unidade = Unidade::findOrFail($idUnidades);
        $locais = Local::orderBy('nome')->paginate(5);
        return view('locais.index',compact('unidade', 'locais'));
    }

    public function getAdicionar($idUnidades){
        $unidade = Unidade::findOrFail($idUnidades);
        return view('locais.adicionar', compact('unidade'));
    }

    public function postSalvar(LocaisRequest $request){
        $this->local->fill($request->all());
        $unidade = Unidade::findOrFail($request->input('idUnidades'));
        $this->local->unidade()->associate($unidade);
        if ($this->local->save()) {
            return redirect('/locais/'.$unidade->id);
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
            return redirect('/locais/'.$this->local->unidade->id);
        }
    }

    public function postExcluir($id){
        $local = $this->local->findOrFail($id);
        $idUnidades = $local->unidade->id;
        $local->delete();
        \Session::flash('message', 'Local excluído com sucesso');
        return redirect('/locais/'.$idUnidades);
    }
}
