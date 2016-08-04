<?php

namespace App\Http\Controllers;

use App\Models\Aparencia;
use App\Models\Evento;
use App\Models\EventoContato;
use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

class EventosController extends Controller
{
    private $evento;

    public function __construct(Evento $evento){
        $this->evento = $evento;
    }

    public function getIndex(){
        $eventos = $this->evento->orderBy('nome')->paginate(5);
        return view('eventos.index', compact('eventos'));
    }

    public function getAdicionar(){
        $contatos = EventoContato::get()->lists('nome', 'id');
        $temas = Aparencia::get()->lists('tema', 'id');
        return view('eventos.adicionar', compact('contatos', 'temas'));
    }

    public function postSalvar(EventosRequest $request){
        \DB::beginTransaction();
        try {
            $this->evento = $this->evento->create($request->get('eventos'));
            $this->evento->eventosContatos()->sync($request->get('eventosContatos'));
            $eventoCaracteristica = $request->eventosCaracteristicas;
            if($request->hasFile('eventosCaracteristicas.logoImagem') && $request->file('eventosCaracteristicas.logoImagem')->isValid()){
                $destino = '/uploads/eventos/';
                $extensao = $request->file('eventosCaracteristicas.logoImagem')->getClientOriginalExtension();
                $arquivoNome = 'logo.'.$extensao;
                $eventoCaracteristica['logo'] = $arquivoNome;
            }
            $this->evento->eventosCaractiristicas()->create($eventoCaracteristica);
        } catch(Exception $e){
            \DB::rollBack();
            \Session::flash('message', 'Falha ao salvar evento');
        }
        \DB::commit();
        return redirect('/eventos');
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
