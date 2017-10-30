<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Models\Atividade;
use App\Models\EventoCaracteristica;
use App\Models\EventoNoticia;
use App\Models\LinkExterno;
use App\Models\UsuarioTipo;
use Carbon\Carbon;
use App\Models\Aparencia;
use App\Models\Evento;
use App\Models\EventoContato;
use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;

use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Mockery\CountValidator\Exception;

class EventosController extends Controller
{
    private $evento;

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function getIndex()
    {
        $eventos = $this->evento
            ->orderBy('nome')
            ->where('idPai', '=', null)
            ->with('eventoCaracteristica')
            ->paginate(5);
        return view('eventos.index', compact('eventos'));
    }

    public function getAdicionar($idPai = 0)
    {
        $contatos = EventoContato::get()->lists('nome', 'id');
        $temas = Aparencia::get()->lists('tema', 'id');
        $tiposDeUsuario = UsuarioTipo::get()->lists('nome', 'id');
        $edicoesAnteriores = $this->evento->lists('nome', 'id');
        $eventoPai = $this->evento->with('eventosContatos')->find($idPai);
        $contatosSelecionados = null;
        if ($eventoPai) {
            $contatosSelecionados = $eventoPai->eventosContatos->pluck('id')->toArray();
        }
        return view('eventos.adicionar', compact('contatos', 'temas', 'edicoesAnteriores', 'eventoPai', 'contatosSelecionados', 'tiposDeUsuario'));
    }

    public function postSalvar(EventosRequest $request, $idPai = 0)
    {
        \DB::transaction(function () use ($request, $idPai) {
            $request->merge(array(
                'dataInicioInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicioInscricao),
                'dataFimInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataFimInscricao),
                'dataInicio' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicio),
                'dataTermino' => Carbon::createFromFormat('d/m/Y H:i', $request->dataTermino)
            ));
            if ($idPai != 0) {
                $request->merge(array(
                    'idPai' => $idPai
                ));
                $eventoPai = $this->evento->findOrFail($idPai);
            }
            $request->merge([
                'nomeSlug' => str_slug($request->nome)
            ]);
            $this->evento = $this->evento->create($request->all());
            $this->evento->eventosContatos()->sync($request->get('eventosContatos'));

            if ($idPai != 0) {
                $this->evento->tiposDeUsuario()->sync($eventoPai->tiposDeUsuario->pluck('id')->all());

                $eventoCaracteristica = $this->evento->eventoPai->eventoCaracteristica->get()->except('id')->toArray();
            } else {
                $this->evento->tiposDeUsuario()->sync($request->get('usuariosTipos'));

                $eventoCaracteristica = $request->eventoCaracteristica;

                if ($request->has('eventoCaracteristica.eImagemDeFundo')) {
                    if ($request->hasFile('eventoCaracteristica.backgroundImagem') && $request->file('eventoCaracteristica.backgroundImagem')->isValid()) {
                        $destino = \App::basePath() . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'eventos' . DIRECTORY_SEPARATOR . $this->evento->id;
                        $extensao = $request->file('eventoCaracteristica.backgroundImagem')->getClientOriginalExtension();
                        $arquivoNome = strtolower('background.' . $extensao);
                        $eventoCaracteristica['background'] = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'eventos' . DIRECTORY_SEPARATOR . $this->evento->id . DIRECTORY_SEPARATOR . $arquivoNome;
                        $request->file('eventoCaracteristica.backgroundImagem')->move($destino, $arquivoNome);
                    }
                }
                if ($request->hasFile('eventoCaracteristica.logoImagem') && $request->file('eventoCaracteristica.logoImagem')->isValid()) {
                    $destino = \App::basePath() . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'eventos' . DIRECTORY_SEPARATOR . $this->evento->id;
                    $extensao = $request->file('eventoCaracteristica.logoImagem')->getClientOriginalExtension();
                    $arquivoNome = strtolower('logo.' . $extensao);
                    $eventoCaracteristica['logo'] = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'eventos' . DIRECTORY_SEPARATOR . $this->evento->id . DIRECTORY_SEPARATOR . $arquivoNome;
                    $request->file('eventoCaracteristica.logoImagem')->move($destino, $arquivoNome);
                }
                if ($eventoCaracteristica['eEmiteCertificado']) {
                    $eventoCaracteristica['dataLiberacaoCertificado'] = Carbon::createFromFormat('d/m/Y', $eventoCaracteristica['dataLiberacaoCertificado']);
                }
            }
            $this->evento->eventoCaracteristica()->create($eventoCaracteristica);
        });
        \Session::flash('message', 'Evento criado com sucesso!');
        return redirect()->route('eventos::index');
    }

    public function getVisualizar($id)
    {
        $evento = $this->evento->findOrFail($id);
        $subeventos = $evento->eventosFilhos()->paginate(5);
        $eventosPai = $evento->getEventosPai();
        if (request()->ajax()) {
            return response()->json(view('subeventos.subeventos')->with([
                'subeventos' => $subeventos
            ])->render());
        }
        return view('eventos.view', compact('evento', 'subeventos', 'eventosPai'));
    }

    public function getEditar($id)
    {
        $evento = $this->evento->with('eventoCaracteristica', 'eventosContatos')->findOrFail($id);
        $contatosSelecionados = $evento->eventosContatos->pluck('id')->toArray();
        $tiposSelecionados = $evento->tiposDeUsuario->pluck('id')->toArray();
        $tiposDeUsuario = UsuarioTipo::get()->lists('nome', 'id');
        $eventosContatos = EventoContato::get()->lists('nome', 'id');
        $temas = Aparencia::get()->lists('tema', 'id');
        $edicoesAnteriores = $this->evento->lists('nome', 'id');
        return view('eventos.editar', compact('evento', 'eventosContatos', 'contatosSelecionados', 'temas', 'edicoesAnteriores', 'tiposDeUsuario', 'tiposSelecionados'));
    }

    public function patchAtualizar(EventosRequest $request, $id)
    {
        $this->evento = $this->evento->findOrFail($id);
        \DB::transaction(function () use ($request) {
            $request->merge(array(
                'dataInicioInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicioInscricao),
                'dataFimInscricao' => Carbon::createFromFormat('d/m/Y H:i', $request->dataFimInscricao),
                'dataInicio' => Carbon::createFromFormat('d/m/Y H:i', $request->dataInicio),
                'dataTermino' => Carbon::createFromFormat('d/m/Y H:i', $request->dataTermino)
            ));
            $request->merge([
                'nomeSlug' => str_slug($request->nome)
            ]);
            $this->evento->fill($request->all());
            $this->evento->update();
            $this->evento->eventosContatos()->sync($request->get('eventosContatos'));
            $this->evento->tiposDeUsuario()->sync($request->get('usuariosTipos'));
            $eventoCaracteristica = $request->get('eventoCaracteristica');
            if ($eventoCaracteristica['eEmiteCertificado']) {
                $eventoCaracteristica['dataLiberacaoCertificado'] = Carbon::createFromFormat('d/m/Y', $eventoCaracteristica['dataLiberacaoCertificado']);
            }
            $this->evento->eventoCaracteristica()->update($eventoCaracteristica);
        });
        \Session::flash('message', 'Evento atualizado com sucesso');
        return redirect()->route('eventos::index');
    }

    public function postExcluir($id)
    {
        $evento = $this->evento->findOrFail($id);
        $evento->delete();
        \Session::flash('message', 'Evento excluído com sucesso');
        return redirect()->route('eventos::index');
    }

    public function salvarLinkExterno(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'url' => 'required|url',
        ]);
        $linkExterno = new LinkExterno();
        $linkExterno->fill($request->all());
        $this->evento = Evento::findOrFail($request->idEventos);
        if (!$this->evento->linksExternos()->save($linkExterno)) {
            return response()->json(['msg' => 'Ocorreu um erro no salvamento'], 400);
        }
        return response()->json(['msg' => 'Link Salvo com Sucesso'], 200);
    }

    public function getIndexPublico($query = null)
    {
        $eventos = $this->evento
            ->orderBy('nome')
            ->where('idPai', '=', null);
        if ($query == 'inscricao') {
            $eventos = $eventos
                ->where('dataInicioInscricao', '>=', Carbon::today()->format('Y-m-d'))
                ->where('dataFimInscricao', '<=', Carbon::today()->format('Y-m-d'));
        } elseif ($query == 'semInscricao') {
            $eventos = $eventos
                ->where('dataInicioInscricao', '<=', Carbon::today()->format('Y-m-d'))
                ->where('dataFimInscricao', '>=', Carbon::today()->format('Y-m-d'))
                ->where('dataTermino', '>=', Carbon::today()->format('Y-m-d'));
        } elseif ($query == 'finalizados') {
            $eventos = $eventos
                ->where('dataTermino', '<=', Carbon::today()->format('Y-m-d'));
        }
        $eventos = $eventos
            ->with('eventoCaracteristica')
            ->paginate(5);
        Carbon::setLocale('pt_BR');
        return view('publico.eventos.index', compact('eventos', 'query'));
    }

    public function getIndexPublicoInscricao()
    {
        $eventos = $this->evento
            ->orderBy('nome')
            ->where('idPai', '=', null)
            ->with('eventoCaracteristica')
            ->paginate(5);
        Carbon::setLocale('pt_BR');
        return view('publico.eventos.index', compact('eventos'));
    }

    public function getAtividadesPublico($nomeSlug)
    {
        Carbon::setLocale('pt_BR');
        $evento = $this->evento
            ->whereNomeslug($nomeSlug)
            ->orderBy('nome')
            ->first();
        $atividades = Atividade::where('idEventos', '=', $evento->id)->aceitas()->paginate(9);
        return view('publico.eventos.atividades', compact('evento', 'atividades'));
    }

    public function getVisualizarPublico($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $subeventos = $evento->eventosFilhos();
        return view('publico.eventos.view', compact('evento', 'subeventos', 'eventosPai'));
    }

    public function getVisualizarAvisos($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $noticias = EventoNoticia::whereIdeventos($evento->id)
            ->orderBy('dataHoraPublicacao')
            ->with('editor')
            ->paginate(5);
        return view('publico.eventos.avisos', compact('evento', 'noticias'));
    }

    public function getVisualizarGaleria($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        return view('publico.eventos.galeria', compact('evento'));
    }

    public function getParticiparEvento($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $evento->participantes()->save(\Auth::user());
        return redirect(route('eventosPublico::visualizar', ['nomeSlug' => $nomeSlug]));
    }
}
