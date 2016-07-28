<?php

namespace App\Http\Controllers;

use App\Models\EventoContato;
use Illuminate\Http\Request;
use App\Http\Requests\EventosContatosRequest;
use App\Http\Requests;

class EventosContatosController extends Controller
{
    private $eventoContato;

    public function __construct(EventoContato $eventoContato){
        $this->eventoContato = $eventoContato;
    }

    public function getIndex(){
        $eventosContatos = $this->eventoContato->orderBy('nome')->paginate(5);
        return view('eventosContatos.index', compact('eventosContatos'));
    }

    public function getAdicionar(){
        return view('eventosContatos.adicionar');
    }

    public function postSalvar(EventosContatosRequest $request){
        $this->eventoContato->fill($request->all());
        $this->eventoContato->redesSociais = implode('<br>', $this->eventoContato->redesSociais);
        if ($this->eventoContato->save()) {
            return redirect('/contatos');
        }
    }

    public function getEditar($id){
        $eventoContato = $this->eventoContato->findOrFail($id);
        $eventoContato->redesSociais = explode('<br>', $eventoContato->redesSociais);
        $eventoContato->facebook = $eventoContato->redesSociais[0];
        $eventoContato->twitter = $eventoContato->redesSociais[1];
        return view('eventosContatos.editar', compact('eventoContato'));
    }

    public function postAtualizar(EventosContatosRequest $request, $id){
        $this->eventoContato = $this->eventoContato->findOrFail($id);
        $this->eventoContato->fill($request->all());
        $this->eventoContato->redesSociais = implode('<br>', $this->eventoContato->redesSociais);
        if ($this->eventoContato->update()) {
            \Session::flash('message', 'EventoContato atualizado com sucesso');
            return redirect('/contatos');
        }
    }

    public function postExcluir($id){
        $eventoContato = $this->eventoContato->findOrFail($id);
        $eventoContato->delete();
        \Session::flash('message', 'EventoContato excluído com sucesso');
        return redirect('/contatos');
    }
}
