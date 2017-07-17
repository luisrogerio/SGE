<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AtividadeDataHora
 *
 * @property integer $id
 * @property integer $idAtividades
 * @property integer $idUnidades
 * @property string $data
 * @property string $horarioInicio
 * @property string $horarioTermino
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereIdAtividades($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereIdUnidades($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereHorarioInicio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereHorarioTermino($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AtividadeDataHora whereSalvoPor($value)
 * @mixin \Eloquent
 * @property int $idLocais
 * @property int $idSalas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeDataHora whereIdLocais($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeDataHora whereIdSalas($value)
 */
class AtividadeDataHora extends Model
{
    protected $table = "atividades_datas_horas";
    protected $fillable =
        [
            'data',
            'horarioInicio',
            'horarioTermino',
            'idUnidades',
            'idLocais',
            'idSalas',
            'idAtividades',
            'salvoPor'
        ];
    protected $dates = [
        'data'
    ];

    public function getHorarioinicioAttribute($value){
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function getHorarioterminoAttribute($value){
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function atividade()
    {
        return $this->belongsTo('App\Models\Atividade', 'idAtividades');
    }

}
