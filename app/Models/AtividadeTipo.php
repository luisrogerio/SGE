<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AtividadeTipo
 *
 * @property integer $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Atividade[] $atividade
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeTipo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeTipo whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeTipo whereSalvoPor($value)
 * @mixin \Eloquent
 */
class AtividadeTipo extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'atividades_tipos';

    public function atividade()
    {
        return $this->hasMany('App\Models\Atividade');
    }
}
