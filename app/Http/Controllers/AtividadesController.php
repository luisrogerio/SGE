<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtividadesRequest;
use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\AtividadeStatus;
use App\Models\AtividadeTipo;
use App\Models\Curso;
use App\Models\Evento;
use App\Models\Local;
use App\Models\Sala;
use App\Models\Unidade;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AtividadesController extends Controller
{
    private $atividade;

    public function __construct(Atividade $atividade)
    {
        $this->atividade = $atividade;
    }

    public function getIndex($idEventos)
    {
        $evento = Evento::findOrFail($idEventos);
        $atividades = $this->atividade->where('idEventos', $idEventos)->orderBy('nome')->paginate(5);
        return view('atividades.index', compact('atividades', 'evento'));
    }

    public function getAdicionar($idEventos)
    {
        $evento = Evento::findOrFail($idEventos);
        $cursos = Curso::get()->lists('sigla', 'id');
        $atividadesTipos = AtividadeTipo::get()->lists('nome', 'id');
        $unidades = Unidade::get()->lists('nome', 'id');
        return view('atividades.adicionar', compact('evento', 'cursos', 'atividadesTipos', 'unidades'));
    }

    public function getView($id)
    {
        $atividade = $this->atividade->findOrFail($id);
        $ultimoStatus = $atividade->statusDeAtividade->last();
        return view('atividades.view', compact('atividade', 'ultimoStatus'));
    }

    public function postSalvar(AtividadesRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $this->atividade->fill($request->all());

            $evento = Evento::findOrFail($this->atividade->idEventos);
            $this->atividade->evento()->associate($evento);

            $unidade = Unidade::find($request->atividades['unidades']);
            $local = Local::find($request->atividades['locais']);
            $sala = Sala::find($request->atividades['salas']);

            $this->atividade->unidade()->associate($unidade);
            $this->atividade->local()->associate($local);
            $this->atividade->sala()->associate($sala);

            $this->atividade->save();

//            $cursos[] = $request->atividades['idCursos'];
//            foreach ($cursos['0'] as $idCursos) {
//                $cursosDatas[$idCursos] =
//                    [
//                        'dataInicio' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataInicio),
//                        'dataFim' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataFim)
//                    ];
//            }

//            $this->atividade->cursos()->sync($cursosDatas);

//            if ($evento->eventoCaracteristica->ePropostaAtividade) {
//                $statusDeAtividade = AtividadeStatus::whereNome('Proposta')->first();
//            } else {
                $statusDeAtividade = AtividadeStatus::whereNome('Aceita')->first();
//            }
            $this->atividade->statusDeAtividade()->attach($statusDeAtividade->id);


            for ($i = 0; $i < count($request->atividades_data); $i++) {
                $this->atividade->atividadesDatasHoras()->create([
                    'data' => Carbon::createFromFormat('d/m/Y', $request->atividades_data[$i]),
                    'horarioInicio' => $request->atividades_horarioInicio[$i],
                    'horarioTermino' => $request->atividades_horarioTermino[$i]
                ]);
            }
        });
        \Session::flash('message', 'Atividade salva com sucesso');
        return redirect()->route('atividades::adicionarResponsavel', [
            'idAtividade' => $this->atividade->id,
            'quantidadeResponsaveis' => $request->atividades['quantidadeResponsaveis']
        ]);
    }

    public function getEditar($id)
    {
        $atividade = $this->atividade->findOrFail($id);
        $cursos = Curso::get()->lists('sigla', 'id');
        $atividadesTipos = AtividadeTipo::get()->lists('nome', 'id');
        $unidades = Unidade::get()->lists('nome', 'id');

        $cursosSelecionados = $atividade->cursos()->pluck('idCursos')->toArray();
        $atividadesTiposSelecionada = $atividade->tipoDeAtividade()->pluck('id')->toArray();
        $unidadesSelecionadas = $atividade->unidade()->pluck('id')->toArray();
        $locaisSelecionados = $atividade->local()->pluck('id')->toArray();
        $salasSelecionados = $atividade->sala()->pluck('id')->toArray();

        $atividadesDataHoras = $atividade->atividadesDatasHoras;
        return view('atividades.editar',
            compact('atividade', 'cursos', 'atividadesTipos', 'unidades', 'cursosSelecionados',
                'atividadesTiposSelecionada', 'unidadesSelecionadas', 'locaisSelecionados', 'salasSelecionados',
                'atividadesDataHoras'));
    }

    public function postAtualizar(AtividadesRequest $request, $id)
    {
        $this->atividade = $this->atividade->findOrFail($id);
        \DB::transaction(function () use ($request) {
            $this->atividade->fill($request->all());

            $unidade = Unidade::find($request->atividades['unidades']);
            $local = Local::find($request->atividades['locais']);
            $sala = Sala::find($request->atividades['salas']);

            $this->atividade->unidade()->associate($unidade);
            $this->atividade->local()->associate($local);
            $this->atividade->sala()->associate($sala);

            if ($this->atividade->update()) {
//                $cursos = $request->atividades['idCursos'];
//                $cursosDatas = array();
//                foreach ($cursos as $idCursos) {
//                    $cursosDatas[$idCursos] =
//                        [
//                            'dataInicio' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataInicio),
//                            'dataFim' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataFim)
//                        ];
//                }
//                $this->atividade->cursos()->sync($cursosDatas);
            }
        });
        \Session::flash('message', 'Atividade atualizado com sucesso');
        return redirect()->route('atividades::view', ['id' => $this->atividade->id]);
    }

    public function postExcluir($id)
    {
        $atividade = $this->atividade->findOrFail($id);
        $idEvento = $atividade->evento->id;
        $atividade->delete();
        \Session::flash('message', 'Atividade excluída com sucesso');
        return redirect()->route('atividades::index', ['idEventos' => $idEvento]);
    }

    public function analisar(Request $request, $id)
    {
        $this->atividade = $this->atividade->findOrFail($id);
        $nomeStatus = '';
        if ($request->status == 'Aprovar') $nomeStatus = 'Aceita';
        if ($request->status == 'Reprovar') $nomeStatus = 'Recusada';
        $status = AtividadeStatus::whereNome($nomeStatus)->first();
        $this->atividade->statusDeAtividade()->attach($status->id, ["observacao" => $request->comentario]);
        return redirect()->back();
    }

    public function getAdicionarPublico($nomeEvento)
    {
        $evento = Evento::whereNomeslug($nomeEvento)->get()->first();
        $cursos = Curso::get()->lists('sigla', 'id');
        $atividadesTipos = AtividadeTipo::get()->lists('nome', 'id');
        $unidades = Unidade::get()->lists('nome', 'id');
        return view('publico.atividades.adicionar', compact('evento', 'cursos', 'atividadesTipos', 'unidades'));
    }

    public function postSalvarPublico(AtividadesRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $this->atividade->fill($request->all());

            $evento = Evento::findOrFail($this->atividade->idEventos);
            $this->atividade->evento()->associate($evento);

//            $unidade = Unidade::find($request->atividades['unidades']);
//            $local = Local::find($request->atividades['locais']);
//            $sala = Sala::find($request->atividades['salas']);
//
//            $this->atividade->unidade()->associate($unidade);
//            $this->atividade->local()->associate($local);
//            $this->atividade->sala()->associate($sala);

            $this->atividade->comentario =
                '<h3>Nome do Proponente: </h3>' . $request->comentarios[5] .
                '<h3>Telefone do Proponente: </h3>' . $request->comentarios[6] .
                '<h3>E-mail do Proponente: </h3>' . $request->comentarios[7] .
                '<h3>Campus de Lotação do Proponente: </h3>' . $request->comentarios[8] .
                '<h3>Área de Conhecimento: </h3>' . $request->comentarios[0] .
                '<h3>Objetivo: </h3>' . $request->comentarios[9] .
                '<h3>Justificativa: </h3>' . $request->comentarios[1] .
                '<h3>Público-Alvo: </h3>' . $request->comentarios[2] .
                '<h3>Recursos/Materiais: </h3>' . $request->comentarios[3] .
                '<h3>Metodologia: </h3>' . $request->comentarios[4];

            $this->atividade->save();

//            $cursos[] = $request->atividades['idCursos'];
//            foreach ($cursos['0'] as $idCursos) {
//                $cursosDatas[$idCursos] =
//                    [
//                        'dataInicio' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataInicio),
//                        'dataFim' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataFim)
//                    ];
//            }

//            $this->atividade->cursos()->sync($cursosDatas);

            if ($evento->eventoCaracteristica->ePropostaAtividade) {
                $statusDeAtividade = AtividadeStatus::whereNome('Proposta')->first();
            } else {
                $statusDeAtividade = AtividadeStatus::whereNome('Aceita')->first();
            }
            $this->atividade->statusDeAtividade()->attach($statusDeAtividade->id);


            for ($i = 0; $i < count($request->atividades_data); $i++) {
                $this->atividade->atividadesDatasHoras()->create([
                    'data' => Carbon::createFromFormat('d/m/Y', $request->atividades_data[$i]),
                    'horarioInicio' => $request->atividades_horarioInicio[$i],
                    'horarioTermino' => $request->atividades_horarioTermino[$i]
                ]);
            }
        });
        \Session::flash('message', 'Atividade Proposta com sucesso. Adicione os Ministrantes da mesma');
        return redirect()->route('adicionarResponsavelPublico', [
            'idAtividade' => $this->atividade->id,
            'quantidadeResponsaveis' => $request->atividades['quantidadeResponsaveis']
        ]);
    }

    public function getAtividade($id)
    {
        $atividade = $this->atividade->withCount('participantes')->findOrFail($id);
        return response()->json(view('publico.eventos.atividadeModal', compact('atividade'))->render());
    }

    public function participarAtividade($id)
    {
        $atividade = $this->atividade->withCount('participantes')->findOrFail($id);
        if (($atividade->participantes_count + 1) >= $atividade->quantidadeVagas) {
            Session::flash('Número de Vagas esgotados');
        } else {
            $atividadesDoUsuario = Atividade::with('atividadesDatasHoras')
                ->select(['atividades.*'])
                ->join('atividades_participantes', 'atividades_participantes.idAtividades', '=', 'atividades.id')
                ->join('usuarios', 'atividades_participantes.idUsuarios', '=', 'usuarios.id')
                ->where('usuarios.id', '=', Auth::user()->id)
                ->where('idEventos', '=', $atividade->evento->id)
                ->get();
            foreach ($atividadesDoUsuario as $atividadeDoUsuario) {
                foreach ($atividadeDoUsuario->atividadesDatasHoras as $atividadeDataHora) {
                    foreach ($atividade->atividadesDatasHoras as $atividadeDataHoraCorrente) {
                        if ($atividadeDataHoraCorrente->data->eq($atividadeDataHora->data)) {
                            if ($atividadeDataHoraCorrente->horarioInicio->between($atividadeDataHora->horarioInicio, $atividadeDataHora->horarioTermino)
                                or $atividadeDataHoraCorrente->horarioTermino->between($atividadeDataHora->horarioInicio, $atividadeDataHora->horarioTermino)) {
                                Session::flash('error', 'Conflito de horários com a Atividade ' . $atividadeDoUsuario->nome . '.');
                                return redirect()->back();
                            }
                        }
                    }
                }
            }
            $atividade->participantes()->save(\Auth::user());
            Session::flash('message', 'Você está agora inscrito na atividade ' . $atividade->nome . '.');
        }
        return redirect()->back();
    }

    public function revovarParticipacaoAtividade($id)
    {
        $atividade = $this->atividade->findOrFail($id);
        $atividade->participantes()->detach(\Auth::user()->id);
        Session::flash('message', 'Você não está mais inscrito na atividade ' . $atividade->nome . '.');
        return redirect()->back();
    }

}
