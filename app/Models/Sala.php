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
 * @property int $idEspacosTipos
 * @property int $quantidade_ocupacao
 * @property-read \App\Models\EspacoTipo $tipoDeEspaco
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sala whereIdEspacosTipos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sala whereQuantidadeOcupacao($value)
 */
class Sala extends Model
{
    protected $fillable = [
        'nome',
        'quantidade_ocupacao'
    ];

    protected $table = 'salas';

    public function local()
    {
        return $this->belongsTo('App\Models\Local', 'idLocais');
    }

    public function tipoDeEspaco()
    {
        return $this->belongsTo('App\Models\EspacoTipo', 'idEspacosTipos');
    }
}
