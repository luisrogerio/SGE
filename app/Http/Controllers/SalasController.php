<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Sala;
use App\Models\Local;
use App\Http\Requests\SalasRequest;

class SalasController extends Controller
{
    private $sala;

    public function __construct(Sala $sala)
    {
        $this->sala = $sala;
    }

    public function getIndex($idLocais)
    {
        $local = Local::findOrFail($idLocais);
        $salas = Sala::orderBy('nome')->paginate(5);
        return view('salas.index', compact('local', 'salas'));
    }

    public function getAdicionar(Request $request, $idLocais)
    {
        $local = Local::findOrFail($idLocais);
        $numeroDeSalas = 1;
        if ($request->exists('numeroDeSalas')) {
            $numeroDeSalas = $request->numeroDeSalas;
        }
        return view('salas.adicionar', compact('numeroDeSalas', 'local'));
    }

    public function postSalvar(SalasRequest $request)
    {
        $local = Local::findOrFail($request->input('idLocais'));
        \DB::transaction(function () use ($request, $local) {
            for ($i = 0; $i < $request->numeroDeSalas; $i++) {
                $this->sala = new Sala;
                if ($request->sufixo[$i] != "") {
                    $this->sala->nome = $request->prefixo[$i] . ' ' . $request->sufixo[$i];
                    $this->sala->local()->associate($local);
                    $this->sala->save();
                }
            }
        });
        return redirect('/salas/' . $local->id);
    }

    public function getEditar($id)
    {
        $sala = $this->sala->findOrFail($id);
        $nomeEmParte = explode(' ', $sala->nome, 2);
        $sala->prefixo = $nomeEmParte[0];
        $sala->sufixo = $nomeEmParte[1];
        return view('salas.editar', compact('sala'));
    }

    public function postAtualizar(SalasRequest $request, $id)
    {
        $this->sala = $this->sala->findOrFail($id);
        $this->sala->nome = $request->prefixo . ' ' . $request->sufixo;
        if ($this->sala->update()) {
            \Session::flash('message', 'Sala atualizada com sucesso');
            return redirect('/salas/' . $this->sala->local->id);
        }
    }

    public function postExcluir($id)
    {
        $sala = $this->sala->findOrFail($id);
        $idLocais = $sala->local->id;
        $sala->delete();
        \Session::flash('message', 'Sala excluída com sucesso');
        return redirect('/salas/' . $idLocais);
    }
}
