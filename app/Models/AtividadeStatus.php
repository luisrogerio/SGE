<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AtividadeStatus
 *
 * @property integer $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeStatus whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeStatus whereSalvoPor($value)
 * @mixin \Eloquent
 */
class AtividadeStatus extends Model
{
    protected $table = 'atividades_status';
    protected $fillable = ['id', 'nome'];
}
