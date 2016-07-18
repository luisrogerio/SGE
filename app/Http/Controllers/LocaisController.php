<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;

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

    public function postSalvar(Request $request){
        $this->validate($request,[
            'nome' => 'required|unique:locais'
        ]);
        $this->local->fill($request->all());
        if ($this->local->save()) {
            return redirect('/locais');
        }
    }

    public function getEditar($id){
        $local = $this->local->find($id);
        return view('locais.editar', compact('local'));
    }

    public function postAtualizar(Request $request, $id){
        $this->validate($request,[
            'nome' => 'required|unique:locais'
        ]);
        $this->local = $this->local->find($id);
        $this->local->fill($request->all());
        if ($this->local->save()) {
            return redirect('/locais');
        }
    }

    public function getExcluir($id){
        $local = $this->local->find($id);
        $local->delete();
        return redirect('/locais');
    }
}
