<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Aparencia
 *
 * @property integer $id
 * @property string $tema
 * @property string $criadoEm
 * @property string $modificadoEm
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aparencia whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aparencia whereTema($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aparencia whereCriadoEm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aparencia whereModificadoEm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Aparencia whereSalvoPor($value)
 * @mixin \Eloquent
 */
class Aparencia extends Model
{
    protected   $table      = 'aparencias';
    protected   $fillable   = [
        'id'            ,
        'nome'          ,
        'criadoEm'      ,
        'modificadoEm'  ,
        'salvoPor'
    ];

    public function eventosCaracteristicas(){
        $this->hasMany('App\Models\EventoCaracteristica','idAparencias');
    }

}
