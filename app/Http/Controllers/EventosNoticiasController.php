<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventosNoticiasRequest;
use App\Models\Evento;
use App\Models\EventoNoticia;
use Carbon\Carbon;

class EventosNoticiasController extends Controller
{
    private $eventoNoticia;

    public function __construct(EventoNoticia $eventoNoticia)
    {
        $this->eventoNoticia = $eventoNoticia;
    }

    public function getIndex($idEventos)
    {
        $evento = Evento::findOrFail($idEventos);
        $eventosNoticias = $this->eventoNoticia->whereIdeventos($idEventos)->orderBy('titulo')->paginate(5);
        return view('eventosNoticias.index', compact('eventosNoticias', 'evento'));
    }

    public function getAdicionar($idEventos)
    {
        return view('eventosNoticias.adicionar', compact('idEventos'));
    }

    public function postSalvar(EventosNoticiasRequest $request, $idEventos)
    {
        $evento = Evento::findOrFail($idEventos);
        $request->merge(array(
            'dataHoraPublicacao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataHoraPublicacao)
        ));
        $this->eventoNoticia->fill($request->all());
        $noticiaWrapped = wordwrap($this->eventoNoticia->noticia, 255, "<br> \n");
        $pedadosDaNoticia = explode("<br> \n", $noticiaWrapped);
        $this->eventoNoticia->preview = rtrim($pedadosDaNoticia[0], ',;!:\'@ ');
        $this->eventoNoticia->salvoPor = \Auth::user()->id;
        if ($evento->eventosNoticias()->save($this->eventoNoticia)) {
            \Session::flash('message', 'Notícia salva com sucesso');
            return redirect()->route('eventosNoticias::index', ['idEventos' => $idEventos]);
        }
    }

    public function getEditar($id)
    {
        $eventoNoticia = $this->eventoNoticia->findOrFail($id);
        return view('eventosNoticias.editar', compact('eventoNoticia'));
    }

    public function postAtualizar(EventosNoticiasRequest $request, $id)
    {
        $this->eventoNoticia = $this->eventoNoticia->findOrFail($id);
        $request->merge(array(
            'dataHoraPublicacao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataHoraPublicacao)
        ));
        $this->eventoNoticia->fill($request->all());
        $noticiaWrapped = wordwrap($this->eventoNoticia->noticia, 255, "<br> \n");
        $pedadosDaNoticia = explode("<br> \n", $noticiaWrapped);
        $this->eventoNoticia->preview = rtrim($pedadosDaNoticia[0], ',;!:\'@ ');
        if ($this->eventoNoticia->update()) {
            \Session::flash('message', 'Notícia atualizada com sucesso');
            return redirect()->route('eventosNoticias::index', ['idEventos' => $this->eventoNoticia->evento->id]);
        }
    }

    public function postExcluir($id)
    {
        $this->eventoNoticia = $this->eventoNoticia->findOrFail($id);
        $idEventos = $this->eventoNoticia->evento->id;
        $this->eventoNoticia->delete();
        \Session::flash('message', 'Notícia excluída com sucesso');
        return redirect()->route('eventosNoticias::index', ['idEventos' => $idEventos]);
    }
}