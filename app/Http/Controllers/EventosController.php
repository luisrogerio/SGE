<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventosController extends Controller
{
    private $evento;

    public function __construct(Evento $evento){
        $this->evento = $evento;
    }

    public function getIndex(){
        $eventos = $this->evento->orderBy('nome')->paginate(5);
        return view('eventos.indexTeste', compact('eventos'));
    }

    public function getAdicionar(){
        return view('eventos.adicionar');
    }

    public function postSalvar(EventosRequest $request){
        $this->evento->fill($request->all());
        if ($this->evento->save()) {
            return redirect('/eventos');
        }
    }

    public function getEditar($id){
        $evento = $this->evento->findOrFail($id);
        return view('eventos.editar', compact('evento'));
    }

    public function postAtualizar(EventosRequest $request, $id){
        $this->evento = $this->evento->findOrFail($id);
        $this->evento->fill($request->all());
        if ($this->evento->update()) {
            \Session::flash('message', 'Evento atualizado com sucesso');
            return redirect('/eventos');
        }
    }

    public function postExcluir($id){
        $evento = $this->evento->findOrFail($id);
        $evento->delete();
        \Session::flash('message', 'Evento excluído com sucesso');
        return redirect('/eventos');
    }
}
