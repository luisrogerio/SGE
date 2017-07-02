<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sala
 *
 * @property integer $id
 * @property integer $idLocais
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\Local $local
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereIdLocais($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sala whereSalvoPor($value)
 * @mixin \Eloquent
 */
class Sala extends Model
{
    protected $fillable = [
        'nome'
    ];

    protected $table = 'salas';

    public function local()
    {
        return $this->belongsTo('App\Models\Local', 'idLocais');
    }
}
