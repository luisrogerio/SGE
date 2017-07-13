<?php

namespace App\Http\Controllers;

use App\Models\EventoContato;
use Illuminate\Http\Request;
use App\Http\Requests\EventosContatosRequest;
use App\Http\Requests;

class EventosContatosController extends Controller
{
    private $eventoContato;

    public function __construct(EventoContato $eventoContato)
    {
        $this->eventoContato = $eventoContato;
    }

    public function getIndex()
    {
        $eventosContatos = $this->eventoContato->orderBy('nome')->paginate(5);
        return view('contatos.index', compact('eventosContatos'));
    }

    public function getAdicionar()
    {
        return view('contatos.adicionar');
    }

    public function postSalvar(EventosContatosRequest $request)
    {
        $this->eventoContato->fill($request->all());
        if ($this->eventoContato->save()) {
            return redirect()->route('contatos::index');
        }
    }

    public function getEditar($id)
    {
        $eventoContato = $this->eventoContato->findOrFail($id);
        return view('contatos.editar', compact('eventoContato'));
    }

    public function postAtualizar(EventosContatosRequest $request, $id)
    {
        $this->eventoContato = $this->eventoContato->findOrFail($id);
        $this->eventoContato->fill($request->all());
        if ($this->eventoContato->update()) {
            \Session::flash('message', 'Contato atualizado com sucesso');
            return redirect()->route('contatos::index');
        }
    }

    public function postExcluir($id)
    {
        $eventoContato = $this->eventoContato->findOrFail($id);
        $eventoContato->delete();
        \Session::flash('message', 'Contato excluído com sucesso');
        return redirect()->route('contatos::index');
    }
}
