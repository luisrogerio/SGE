<?php

namespace App\Http\Controllers;

use App\Models\EspacoTipo;
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
        $tiposDeEspaco = EspacoTipo::get()->pluck('nome', 'id');
        return view('salas.adicionar', compact('numeroDeSalas', 'local', 'tiposDeEspaco'));
    }

    public function postSalvar(SalasRequest $request)
    {
        $local = Local::findOrFail($request->input('idLocais'));
        \DB::transaction(function () use ($request, $local) {
            for ($i = 0; $i < $request->numeroDeSalas; $i++) {
                $this->sala = new Sala;
                if ($request->nome[$i] != "") {
                    $this->sala->nome = $request->nome[$i];
                    $this->sala->quantidade_ocupacao = $request->quantidade_ocupacao[$i];
                    $this->sala->idEspacosTipos = $request->tipoDeEspaco[$i];
                    $this->sala->local()->associate($local);
                    $this->sala->save();
                }
            }
        });
        return redirect()->route('salas::index', ['idLocais' => $local->id]);
    }

    public function getEditar($id)
    {
        $sala = $this->sala->findOrFail($id);
        $tiposDeEspaco = EspacoTipo::get()->pluck('nome', 'id');
        return view('salas.editar', compact('sala', 'tiposDeEspaco'));
    }

    public function postAtualizar(SalasRequest $request, $id)
    {
        $this->sala = $this->sala->findOrFail($id);
        $this->sala->fill($request->all());
        $this->sala->idEspacosTipos = $request->tipoDeEspaco;
        if ($this->sala->update()) {
            \Session::flash('message', 'Sala atualizada com sucesso');
            return redirect()->route('salas::index', ['idLocais' => $this->sala->local->id]);
        }
    }

    public function postExcluir($id)
    {
        $sala = $this->sala->findOrFail($id);
        $idLocais = $sala->local->id;
        $sala->delete();
        \Session::flash('message', 'Sala excluída com sucesso');
        return redirect()->route('salas::index', ['idLocais' => $idLocais]);
    }

    public function getSalasByLocais($idLocais){
        $salas = $this->sala->where('idLocais', '=', $idLocais)->get()->lists('nome', 'id');
        return response()->json([$salas->toJson()], 200);
    }
}
