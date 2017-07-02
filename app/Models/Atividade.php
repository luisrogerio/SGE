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
        'funcaoResponsavel',
        'descricao',
        'salvoPor'
    ];

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

//    public function atividadesDatas(){
//        return $this->hasMany('App\Models\AtividadeData', 'idAtividades');
//    }

    public function atividadesDatasHoras()
    {
        return $this->hasMany('App\Models\AtividadeDataHora', 'idAtividades');
    }

    public function atividadesResponsaveis()
    {
        return $this->hasMany('App\Models\AtividadeResponsavel', 'idAtividades');
    }

//    public function horarios()
//    {
//        return $this->hasManyThrough('App\Models\Horario', 'App\Models\AtividadeData', 'idAtividades', 'idAtividadesDatas', 'id');
//    }
}
