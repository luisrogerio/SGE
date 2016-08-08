<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class Aparencia extends Model
{
    public      $timestamps = false;
    protected   $table      = 'aparencias';
    protected   $fillable   = [
        'id'            ,
        'nome'          ,
        'criadoEm'      ,
        'modificadoEm'  ,
        'salvoPor'
    ];

    public function eventosCaracteristicas(){
        $this->hasMany('SGE\Models\EventoCaracteristica','idAparencias');
    }

}
