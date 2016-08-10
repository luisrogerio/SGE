<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $eventos = $this->evento->orderBy('nome')->with('eventoCaracteristica')->paginate(5);
        return view('eventos.index', compact('eventos'));
    }

    public function getAdicionar(){
        $contatos = EventoContato::get()->lists('nome', 'id');
        $temas = Aparencia::get()->lists('tema', 'id');
        $edicoesAnteriores = $this->evento->lists('nome', 'id');
        return view('eventos.adicionar', compact('contatos', 'temas', 'edicoesAnteriores'));
    }

    public function postSalvar(EventosRequest $request){
        \DB::beginTransaction();
        try {
            $request->merge(array(
                'dataInicioInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicioInscricao),
                'dataFimInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataFimInscricao),
                'dataInicio' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicio),
                'dataTermino' => Carbon::createFromFormat('d/m/Y H:i', $request->dataTermino)
            ));
            $this->evento = $this->evento->create($request->all());
            $this->evento->eventosContatos()->sync($request->get('eventosContatos'));
            $eventoCaracteristica = $request->eventoCaracteristica;
            $eventoCaracteristica['dataLiberacaoCertificado'] = Carbon::createFromFormat('d/m/Y H:i', $eventoCaracteristica['dataLiberacaoCertificado']);
            if($request->has('eventoCaracteristica.eImagemDeFundo')){
                if($request->hasFile('eventoCaracteristica.backgroundImagem') && $request->file('eventoCaracteristica.backgroundImagem')->isValid()){
                    $destino = \App::publicPath().'/uploads/eventos/'.$this->evento->id;
                    $extensao = $request->file('eventoCaracteristica.backgroundImagem')->getClientOriginalExtension();
                    $arquivoNome = 'background.'.$extensao;
                    $eventoCaracteristica['background'] = $arquivoNome;
                    $request->file('eventoCaracteristica.backgroundImagem')->move($destino, $arquivoNome);
                }
            }
            if($request->hasFile('eventoCaracteristica.logoImagem') && $request->file('eventoCaracteristica.logoImagem')->isValid()){
                $destino = \App::publicPath().'/uploads/eventos/'.$this->evento->id;
                $extensao = $request->file('eventoCaracteristica.logoImagem')->getClientOriginalExtension();
                $arquivoNome = 'logo.'.$extensao;
                $eventoCaracteristica['logo'] = $arquivoNome;
                $request->file('eventoCaracteristica.logoImagem')->move($destino, $arquivoNome);
            }
            $this->evento->eventoCaracteristica()->create($eventoCaracteristica);
        } catch(Exception $e){
            \DB::rollBack();
            \Session::flash('message', 'Falha ao salvar evento');
        }
        \DB::commit();
        return redirect('/eventos');
    }

    public function getVisualizar($id){
        $evento = $this->evento->findOrFail($id);
        return view('eventos.view', compact('evento'));
    }

    public function getEditar($id){
        $evento = $this->evento->with('eventoCaracteristica', 'eventosContatos')->findOrFail($id);
        $contatosSelecionados = $evento->eventosContatos->pluck('id')->toArray();
        $eventosContatos = EventoContato::get()->lists('nome', 'id');
        $temas = Aparencia::get()->lists('tema', 'id');
        $edicoesAnteriores = $this->evento->lists('nome', 'id');
        return view('eventos.editar', compact('evento', 'eventosContatos', 'contatosSelecionados', 'temas', 'edicoesAnteriores'));
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
