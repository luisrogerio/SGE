<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = [
        'id',
        'idEdicaoAnterior',
        'idEventosCaracteristicas',
        'idPai',
        'nome',
        'dataInicioInscricao',
        'dataFimInscricao',
        'dataInicio',
        'dataFim',
        'descricao',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];
    public $timestamps = false;
}
