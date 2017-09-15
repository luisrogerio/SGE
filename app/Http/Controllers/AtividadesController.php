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

            $cursos[] = $request->atividades['idCursos'];
            foreach ($cursos as $idCursos) {
                $cursosDatas[$idCursos] =
                    [
                        'dataInicio' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataInicio),
                        'dataFim' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataFim)
                    ];
            }

            $this->atividade->cursos()->sync($cursosDatas);

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
                $cursos = $request->atividades['idCursos'];
                $cursosDatas = array();
                foreach ($cursos as $idCursos) {
                    $cursosDatas[$idCursos] =
                        [
                            'dataInicio' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataInicio),
                            'dataFim' => Carbon::createFromFormat("d/m/Y", $request->atividadesCursos_dataFim)
                        ];
                }
                $this->atividade->cursos()->sync($cursosDatas);
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
}
