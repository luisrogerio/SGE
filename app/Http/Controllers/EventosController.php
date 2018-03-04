<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\AtividadeDataHora;
use App\Models\AtividadeResponsavel;
use App\Models\AutorAvaliador;
use App\Models\EventoNoticia;
use App\Models\LinkExterno;
use App\Models\Usuario;
use App\Models\UsuarioTipo;
use Carbon\Carbon;
use App\Models\Aparencia;
use App\Models\Evento;
use App\Models\EventoContato;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Pdf;

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
            'titulo' => 'required',
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

    public function removerLinkExterno($idLink)
    {
        $linkExterno = LinkExterno::findOrFail($idLink);
        if ($linkExterno->delete()) {
            Session::flash('message', 'Link removido com sucesso');
        } else {
            Session::flash('message', 'Houve um erro ao tentar remover o link');
        }
        return redirect()->back();
    }

    public function getCredenciamento($nomeSlug)
    {
        $evento = $this->evento->with('participantes')->whereNomeslug($nomeSlug)->first();
        $participantesPorLetra = $evento->participantes->map(function ($item, $key) {
            return mb_strtoupper($item->nome, 'UTF-8');
        })->sort()->groupBy(function ($item, $key) {
            return mb_strtoupper($item[0], 'UTF-8');
        });
        return \PDF::loadHtml(view('admin.eventos.listaCredenciamento', compact('evento', 'participantesPorLetra'))->render())->inline();
    }

    public function getRelatorioAtividades($nomeSlug)
    {
        $evento = $this->evento->with('participantes')->whereNomeslug($nomeSlug)->first();
        $atividades = Atividade::aceitas()->where('idEventos', '=', $evento->id)->orderBy('nome')->withCount('participantes')->paginate(10);
        return view('admin.eventos.relatoriosPresenca', compact('evento', 'atividades'));
    }

    public function getListasDePresencas($nomeSlug)
    {
        $evento = $this->evento->with('participantes')->whereNomeslug($nomeSlug)->first();
        $atividades = Atividade::aceitas()->where('idEventos', '=', $evento->id)->orderBy('nome')->withCount('participantes')->get();
        $views = "<html>";
        foreach ($atividades as $atividade) {
            if ($atividade->participantes_count >= 200) {
                $participantesPorLetra = $atividade->participantes->map(function ($item, $key) {
                    return mb_strtoupper($item->nome, 'UTF-8');
                })->sort()->groupBy(function ($item, $key) {
                    return mb_strtoupper($item[0], 'UTF-8');
                });
                $view = view('admin.eventos.listaPresencaPorLetra', compact('atividade', 'participantesPorLetra'))->render();
            } else {
                $view = view('admin.eventos.listaPresenca', compact('atividade'))->render();
            }
            $views = $views . $view;
        }
        $views = $views . "</html>";
        $pdf = \PDF::loadHtml($views);
        return $pdf->inline();
    }

    public function getListaDePresenca($id)
    {
        $atividade = Atividade::with('participantes')->findOrFail($id);
        if ($atividade->participantes_count >= 200) {
            $participantesPorLetra = $atividade->participantes->map(function ($item, $key) {
                return mb_strtoupper($item->nome, 'UTF-8');
            })->sort()->groupBy(function ($item, $key) {
                return mb_strtoupper($item[0], 'UTF-8');
            });
            $view = view('admin.eventos.listaPresencaPorLetra', compact('atividade', 'participantesPorLetra'))->render();
        } else {
            $view = view('admin.eventos.listaPresenca', compact('atividade'))->render();
        }
        $pdf = \PDF::loadHtml($view);
        return $pdf->inline();
    }

    public function getLancamentoDePresencaEvento($id)
    {
        $evento = Evento::with('participantes')->findOrFail($id);
        return view('admin.eventos.lancamentoDePresencaEvento', compact('evento'));
    }

    public function getLancamentoDePresenca($id)
    {
        $atividade = Atividade::with('participantes')->findOrFail($id);
        return view('admin.eventos.lancamentoDePresenca', compact('atividade'));
    }

    public function getLancamentoDePresencaTrabalhos($id)
    {
        $evento = Evento::with('trabalhos')->findOrFail($id);
        $trabalhos = AutorAvaliador::select('idTrabalho', 'tituloTrabalho')
            ->where('evento_id', '=', $evento->id)
            ->where('relacaoTrabalho', '=', 1)
            ->groupBy('idTrabalho')
            ->groupBy('tituloTrabalho')
            ->orderBy('tituloTrabalho')
            ->get();
        return view('admin.eventos.lancamentoDePresencaTrabalhos', compact('evento', 'trabalhos'));
    }

    public function getLancamentoDePresencaTrabalho($id)
    {
        $trabalhos = AutorAvaliador::
        where('idTrabalho', '=', $id)
            ->where('relacaoTrabalho', '=', 1)
            ->get();
        return view('admin.eventos.lancamentoDePresencaTrabalho', compact('trabalhos', 'id'));
    }

    public function getLancarPresencaEvento(Request $request, $id)
    {
        $evento = Evento::with('participantes')->findOrFail($id);
        $listaDePresentes = collect($request->presenca);
        foreach ($evento->participantes as $participante) {
            if ($listaDePresentes->contains($participante->id)) {
                $participante->pivot->presenca = true;
            } else {
                $participante->pivot->presenca = false;
            }
            $participante->pivot->save();
        }
        return redirect()->route('eventos::lancamentoDePresencaEvento', ['id' => $id]);
    }

    public function getLancarPresenca(Request $request, $id)
    {
        $atividade = Atividade::with('participantes')->findOrFail($id);
        $listaDePresentes = collect($request->presenca);
        foreach ($atividade->participantes as $participante) {
            if ($listaDePresentes->contains($participante->id)) {
                $participante->pivot->presenca = true;
            } else {
                $participante->pivot->presenca = false;
            }
            $participante->pivot->save();
        }
        return redirect()->route('eventos::lancamentoDePresenca', ['id' => $id]);
    }

    public function getLancarPresencaTrabalhos(Request $request, $id)
    {
        $eventoId = null;
        $trabalhos = AutorAvaliador::where('idTrabalho', '=', $id)
            ->where('relacaoTrabalho', '=', 1)->get();
        foreach ($trabalhos as $trabalho) {
            $eventoId = $trabalho->evento_id;
            $trabalho->presenca = $request->presenca[$trabalho->id];
            $trabalho->apresentacao = $request->apresentacao[$trabalho->id];
            $trabalho->save();
        }
        return redirect()->route('eventos::lancamentoDePresencaTrabalhos', ['id' => $eventoId]);
    }

    public function getIndexPublico($query = null)
    {
        $eventos = $this->evento
            ->orderBy('nome')
            ->where('idPai', '=', null);
        if ($query == 'inscricao') {
            $eventos = $eventos
                ->where('dataInicioInscricao', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                ->where('dataFimInscricao', '>=', Carbon::now()->format('Y-m-d H:i:s'));
        } elseif ($query == 'semInscricao') {
            $eventos = $eventos
                ->where('dataInicioInscricao', '>=', Carbon::now()->format('Y-m-d H:i:s'))
                ->orWhere('dataFimInscricao', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                ->where('dataTermino', '>=', Carbon::today()->format('Y-m-d'))
                ->orWhere('dataInicio', '<=', Carbon::today()->format('Y-m-d'));
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
        $atividades = Atividade::aceitas()->where('idEventos', '=', $evento->id)->orderBy('nome')->withCount('participantes')->paginate(9);
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
            ->where('dataHoraPublicacao', '<=', date("Y-m-d H:i:s"))
            ->orderBy('dataHoraPublicacao', 'desc')
            ->with('editor')
            ->paginate(5);
        return view('publico.eventos.avisos', compact('evento', 'noticias'));
    }

    public function getVisualizarGaleria($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        return view('publico.eventos.galeria', compact('evento'));
    }

    public function getMinhaAgenda($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $atividadesDatasHoras = AtividadeDataHora::
        select('atividades_datas_horas.*')
            ->join('atividades as at', 'atividades_datas_horas.idAtividades', '=', 'at.id')
            ->join('eventos as e', 'at.idEventos', '=', 'e.id')
            ->join('atividades_participantes as ap', 'at.id', '=', 'ap.idAtividades')
            ->join('usuarios as u', 'ap.idUsuarios', '=', 'u.id')
            ->where('e.id', '=', $evento->id)
            ->where('u.id', '=', auth()->user()->id)
            ->orderBy('data', 'asc')
            ->orderBy('horarioInicio', 'asc')
            ->get();
        $start = $evento->dataInicio;
        $end = $evento->dataTermino;

        $diasDoEvento = [];

        $date = $start;
        while ($date <= $end) {

            if (!$date->isWeekend()) {
                $diasDoEvento[] = $date->copy();
            }
            $date->addDays(1);
        }
        $diasDoEvento = collect($diasDoEvento);
        return view('publico.eventos.agenda', compact('evento', 'atividadesDatasHoras', 'diasDoEvento'));
    }

    public function getVisualizarCertificados($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $atividadesCertificadas = Atividade::atividadesPresente(\Auth::user()->id)->get();
        $trabalhosCertificados = AutorAvaliador::trabalhosPresente(\Auth::user()->id)->get();
        return view('publico.eventos.certificados', compact('evento', 'atividadesCertificadas', 'trabalhosCertificados'));
    }

    public function getParticiparEvento($nomeSlug)
    {
        $evento = $this->evento->whereNomeslug($nomeSlug)->first();
        $evento->participantes()->save(\Auth::user());
        Session::flash('message', 'Você está agora inscrito no evento ' . $evento->nome . '.');
        return redirect(route('eventosPublico::visualizar', ['nomeSlug' => $nomeSlug]));
    }

    public function getCertificarEvento($nomeSlug)
    {
        $evento = $this->evento->with('participantes')->whereNomeslug($nomeSlug)->first();
        if ($evento->participantes->contains(\Auth::user())) {
            $participante = $evento->participantes->where('id', \Auth::user()->id)->first();
            if ($participante->pivot->presenca == true) {
                $codigoAutenticidade = encrypt('E' . $participante->pivot->id);
                return \PDF::loadHtml(
                    view('publico.certificados.certificadoEvento',
                        compact('evento', 'participante', 'codigoAutenticidade'))->render())
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-bottom', 0)
                    ->download('Certificado' . str_slug($evento->nome) . '.pdf');
            }
        }
        return back();
    }

    public function getCertificarAtividade($id)
    {
        $atividade = Atividade::with('participantes')->findOrFail($id);
        if ($atividade->participantes->contains(\Auth::user())) {
            $participante = $atividade->participantes->where('id', \Auth::user()->id)->first();
            if ($participante->pivot->presenca == true) {
                $codigoAutenticidade = encrypt('A' . $participante->pivot->id);
                $cargaEmSegundos = 0;
                foreach ($atividade->atividadesDatasHoras as $atividadeDatasHora) {
                    $cargaEmSegundos += ($atividadeDatasHora->horarioTermino->diffInSeconds($atividadeDatasHora->horarioInicio));
                }
                $cargaHoraria = gmdate("H:i", $cargaEmSegundos);
                return \PDF::loadHtml(
                    view('publico.certificados.certificadoAtividade',
                        compact('atividade', 'participante', 'cargaHoraria', 'codigoAutenticidade'))->render())
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-bottom', 0)
                    ->download('Certificado' . str_slug($atividade->nome) . '.pdf');
            }
        }
        return back();
    }


    public function getCertificarAutor($id)
    {
        $trabalho = AutorAvaliador::findOrFail($id);
        if (($trabalho->idUser == \Auth::user()) && ($trabalho->presenca == true) && ($trabalho->relacaoTrabalho == 1)) {
            $codigoAutenticidade = encrypt('W' . $trabalho->id);
            return \PDF::loadHtml(
                view('publico.certificados.certificadoAutor',
                    compact('trabalho', 'codigoAutenticidade'))->render())
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->download('Certificado' . str_slug("autor" . $trabalho->tituloTrabalho) . '.pdf');
        }
        return back();
    }

    public function getCertificarBanner($id)
    {
        $trabalho = AutorAvaliador::findOrFail($id);
        if (($trabalho->idUser == \Auth::user()) && ($trabalho->presenca == true) && ($trabalho->apresentacao == 1)
            && ($trabalho->relacaoTrabalho == 1)) {
            $codigoAutenticidade = encrypt('B' . $trabalho->id);
            return \PDF::loadHtml(
                view('publico.certificados.certificadoBanner',
                    compact('trabalho', 'codigoAutenticidade'))->render())
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->download('Certificado' . str_slug("banner" . $trabalho->tituloTrabalho) . '.pdf');
        }
        return back();
    }

    public function getCertificarOral($id)
    {
        $trabalho = AutorAvaliador::findOrFail($id);
        if (($trabalho->idUser == \Auth::user()) && ($trabalho->presenca == true) && ($trabalho->apresentacao == 2)
            && ($trabalho->relacaoTrabalho == 1)) {
            $codigoAutenticidade = encrypt('O' . $trabalho->id);
            return \PDF::loadHtml(
                view('publico.certificados.certificadoOral',
                    compact('trabalho', 'codigoAutenticidade'))->render())
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->download('Certificado' . str_slug("oral" . $trabalho->tituloTrabalho) . '.pdf');
        }
        return back();
    }

    public function getCertificarRevisor($id)
    {
        $trabalho = AutorAvaliador::findOrFail($id);
        if (($trabalho->idUser == \Auth::user()) && ($trabalho->relacaoTrabalho == 2)) {
            $codigoAutenticidade = encrypt('R' . $trabalho->id);
            return \PDF::loadHtml(
                view('publico.certificados.certificadoRevisor',
                    compact('trabalho', 'codigoAutenticidade'))->render())
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->download('Certificado' . str_slug("revisor" . $trabalho->tituloTrabalho) . '.pdf');
        }
        return back();
    }

    public function getCertificarMinistrantes($id)
    {
        $atividade = Atividade::with('atividadesResponsaveis')->findOrFail($id);
        $view = "<html>";

        $cargaEmSegundos = 0;
        foreach ($atividade->atividadesDatasHoras as $atividadeDatasHora) {
            $cargaEmSegundos += ($atividadeDatasHora->horarioTermino->diffInSeconds($atividadeDatasHora->horarioInicio));
        }
        $cargaHoraria = gmdate("H:i", $cargaEmSegundos);

        foreach ($atividade->atividadesResponsaveis as $atividadesResponsavel) {
            $codigoAutenticidade = encrypt('M' . $atividadesResponsavel->id);
            $view .= view('publico.certificados.certificadoMinistrantes',
                compact('atividade', 'codigoAutenticidade', 'cargaHoraria', 'atividadesResponsavel'))->render();
        }
        $view .= "</html>";

        return \PDF::loadHtml($view)
            ->setPaper('a4')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', 0)
            ->download('Certificado' . str_slug($atividade->nome) . '.pdf');
    }

    public function getAutenticarCertificado($codigo)
    {
        $codigoResolvido = decrypt($codigo);
        $codigoCertificacao = substr($codigoResolvido, 0, 1);
        $idCertificado = substr($codigoResolvido, 1);
        $informacoes = "";
        switch ($codigoCertificacao){
            case "A":
                $atividade = Atividade::atividadePivot($idCertificado)->get()->first();
                $atividadesDatasHoras = AtividadeDataHora::whereIdatividades($atividade->id)->get();
                $participante = Usuario::usuarioPivotAtividade($idCertificado)->get()->first();
                $cargaEmSegundos = 0;
                foreach ($atividadesDatasHoras as $atividadeDatasHora) {
                    $cargaEmSegundos += ($atividadeDatasHora->horarioTermino->diffInSeconds($atividadeDatasHora->horarioInicio));
                }
                $cargaHoraria = gmdate("H:i", $cargaEmSegundos);

                $informacoes = "Certificado do(a) ".$atividade->nome."
                                .<br> Participante: ".$participante->nome."
                                .<br> Carga Horária: ".$cargaHoraria."h.";
                break;
            case "E":
                $evento = Evento::eventoPivot($idCertificado)->get()->first();
                $participante = Usuario::usuarioPivotEvento($idCertificado)->get()->first();
                $informacoes = "Certificado do evento ".$evento->nome."
                                .<br> Participante: ".$participante->nome."
                                .<br> Carga Horária: 24h.";
                break;
            case 'W':
                $trabalho = AutorAvaliador::findOrFail($idCertificado);
                if(($trabalho->presenca == true) && ($trabalho->relacaoTrabalho == 1)){
                    $informacoes = "Certificado do(a) trabalho ".$trabalho->tituloTrabalho."
                                .<br> Autor: ".$trabalho->nomePessoa.".";
                }
                break;
            case 'W':
                $trabalho = AutorAvaliador::findOrFail($idCertificado);
                if($trabalho->presenca == true){
                    $informacoes = "Certificado do(a) trabalho ".$trabalho->tituloTrabalho."
                                .<br> Autor: ".$trabalho->nomePessoa.".";
                }
                break;
            case 'B':
                $trabalho = AutorAvaliador::findOrFail($idCertificado);
                if(($trabalho->presenca == true) && ($trabalho->apresentacao == 1) && ($trabalho->relacaoTrabalho == 1)){
                    $informacoes = "Certificado do(a) trabalho ".$trabalho->tituloTrabalho."
                                .<br> Apresentador do Pôster: ".$trabalho->nomePessoa.".";
                }
                break;
            case 'O':
                $trabalho = AutorAvaliador::findOrFail($idCertificado);
                if(($trabalho->presenca == true) && ($trabalho->apresentacao == 2) && ($trabalho->relacaoTrabalho == 1)){
                    $informacoes = "Certificado do(a) trabalho ".$trabalho->tituloTrabalho."
                                .<br> Apresentador Oral: ".$trabalho->nomePessoa.".";
                }
                break;
            case 'R':
                $trabalho = AutorAvaliador::findOrFail($idCertificado);
                if($trabalho->relacaoTrabalho == 2){
                    $informacoes = "Certificado do(a) trabalho ".$trabalho->tituloTrabalho."
                                .<br> Revisor: ".$trabalho->nomePessoa.".";
                }
                break;
            case 'M':
                $ministrante = AtividadeResponsavel::findOrFail($idCertificado);
                $atividade = $ministrante->atividade;

                $cargaEmSegundos = 0;
                foreach ($atividade->atividadesDatasHoras as $atividadeDatasHora) {
                    $cargaEmSegundos += ($atividadeDatasHora->horarioTermino->diffInSeconds($atividadeDatasHora->horarioInicio));
                }
                $cargaHoraria = gmdate("H:i", $cargaEmSegundos);

                $informacoes = "Certificado do(a) ".$atividade->atividadeTipo." ".$atividade->nome."
                                .<br> Ministrante: ".$ministrante->nome."
                                .<br> Carga Horária: ".$cargaHoraria."h.";
                break;
            default:
                $informacoes = "Houve um erro ao ler o código. Favor informar o suporte sobre este erro!";
                break;
        }
        return view('publico.autenticidade', compact('informacoes'));

    }

}
