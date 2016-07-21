<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';
    protected $fillable = [
        'id',
        'idEventos',
        'idAtividadesTipos',
        'nome',
        'quantidadeVagas',
        'descricao',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];
    public $timestamps = false;

    public function atividadesTipos(){
        return $this->hasOne('App\Models\AtividadeTipo', 'idAtividadesTipos');
    }
}
