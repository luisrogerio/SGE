<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Curso
 *
 * @property integer $id
 * @property string $nome
 * @property string $sigla
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Atividade[] $atividade
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereSigla($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Curso whereSalvoPor($value)
 * @mixin \Eloquent
 */
class Curso extends Model
{
    protected $table = 'cursos';
    protected $fillable = ['id', 'nome', 'sigla'];

    public function atividade()
    {
        return $this->belongsToMany('App\Models\Atividade', 'atividades_cursos', 'idCursos', 'idAtividades');
    }
}
