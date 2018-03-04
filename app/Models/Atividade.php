<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Atividade
 *
 * @property integer $id
 * @property integer $idEventos
 * @property integer $idAtividadesTipos
 * @property string $nome
 * @property integer $quantidadeVagas
 * @property string $descricao
 * @property string $funcaoResponsavel
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\AtividadeTipo $tipoDeAtividade
 * @property-read \App\Models\Evento $evento
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AtividadeStatus[] $statusDeAtividade
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Curso[] $cursos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AtividadeDataHora[] $atividadesDatasHoras
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereIdEventos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereIdAtividadesTipos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereQuantidadeVagas($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereDescricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereFuncaoResponsavel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Atividade whereSalvoPor($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AtividadeResponsavel[] $atividadesResponsaveis
 * @property int $idUnidades
 * @property int $idLocais
 * @property int $idSalas
 * @property-read \App\Models\Local $local
 * @property-read \App\Models\Sala $sala
 * @property-read \App\Models\Unidade $unidade
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Atividade aceitas()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Atividade whereIdLocais($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Atividade whereIdSalas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Atividade whereIdUnidades($value)
 * @property string $comentario
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Usuario[] $participantes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Atividade whereComentario($value)
 */
class Atividade extends Model
{
    protected $table = 'atividades';
    protected $fillable = [
        'id',
        'idEventos',
        'idAtividadesTipos',
        'nome',
        'quantidadeVagas',
        'descricao',
        'comentario',
        'salvoPor'
    ];

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Curso) {
            return new AtividadeCursoPivot($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }

    public function tipoDeAtividade()
    {
        return $this->belongsTo('App\Models\AtividadeTipo', 'idAtividadesTipos');
    }

    public function evento()
    {
        return $this->belongsTo('App\Models\Evento', 'idEventos');
    }

    public function statusDeAtividade()
    {
        return $this->belongsToMany('App\Models\AtividadeStatus', 'atividades_atividades_status', 'idAtividades', 'idAtividadesStatus')->withPivot('observacao');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Models\Curso', 'atividades_cursos', 'idAtividades', 'idCursos')->withPivot('dataInicio', 'dataFim');
    }

    public function atividadesDatasHoras()
    {
        return $this->hasMany('App\Models\AtividadeDataHora', 'idAtividades');
    }

    public function atividadesResponsaveis()
    {
        return $this->hasMany('App\Models\AtividadeResponsavel', 'idAtividades');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Models\Unidade', 'idUnidades');
    }

    public function local()
    {
        return $this->belongsTo('App\Models\Local', 'idLocais');
    }

    public function sala()
    {
        return $this->belongsTo('App\Models\Sala', 'idSalas');
    }

    public function participantes()
    {
        return $this->belongsToMany('App\Models\Usuario', 'atividades_participantes', 'idAtividades', 'idUsuarios')->withPivot('id', 'presenca')->orderBy('nome');
    }

    public function scopeAtividadesPresente($query, $idUsuario) {
        return $query->whereHas('participantes', function ($q) use ($idUsuario) {
            $q->where('atividades_participantes.presenca', '=', true)
            ->where('atividades_participantes.idUsuarios', '=', $idUsuario);
        });
    }

    public function scopeAtividadePivot($query, $idPivot) {
        return $query->whereHas('participantes', function ($q) use ($idPivot) {
            $q->where('atividades_participantes.presenca', '=', true)
                ->where('atividades_participantes.id', '=', $idPivot);
        });
    }

    public function isParticipante($id)
    {
        $participante = Usuario::findOrFail($id);
        return (bool) $this->participantes()->get()->contains($participante);
    }

    public function scopeAceitas($query)
    {
        return $query
            ->select('atividades.*')
            ->join('atividades_atividades_status', 'atividades.id', '=', 'atividades_atividades_status.idAtividades')
            ->join('atividades_status', 'atividades_status.id', '=', 'atividades_atividades_status.idAtividadesStatus')
            ->where('atividades_status.id', '=', 3);
    }

}
