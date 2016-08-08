<?php

namespace SGE\Http\Controllers;

use SGE\Models\EventoContato;
use Illuminate\Http\Request;
use SGE\Http\Requests\EventosContatosRequest;
use SGE\Http\Requests;

class EventosContatosController extends Controller
{
    private $eventoContato;

    public function __construct(EventoContato $eventoContato){
        $this->eventoContato = $eventoContato;
    }

    public function getIndex(){
        $eventosContatos = $this->eventoContato->orderBy('nome')->paginate(5);
        return view('contatos.index', compact('eventosContatos'));
    }

    public function getAdicionar(){
        return view('contatos.adicionar');
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
        return view('contatos.editar', compact('eventoContato'));
    }

    public function postAtualizar(EventosContatosRequest $request, $id){
        $this->eventoContato = $this->eventoContato->findOrFail($id);
        $this->eventoContato->fill($request->all());
        $this->eventoContato->redesSociais = implode('<br>', $this->eventoContato->redesSociais);
        if ($this->eventoContato->update()) {
            \Session::flash('message', 'Contato atualizado com sucesso');
            return redirect('/contatos');
        }
    }

    public function postExcluir($id){
        $eventoContato = $this->eventoContato->findOrFail($id);
        $eventoContato->delete();
        \Session::flash('message', 'Contato excluído com sucesso');
        return redirect('/contatos');
    }
}
