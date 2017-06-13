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
        'nodificadoEm',
        'salvoPor'
    ];

    public function atividadesTipos()
    {
        return $this->belongsTo('App\Models\AtividadeTipo', 'idAtividadesTipos');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Models\Curso', 'atividades_cursos', 'idAtividades', 'idCursos');
    }

//    public function atividadesDatas(){
//        return $this->hasMany('App\Models\AtividadeData', 'idAtividades');
//    }

    public function atividadesDatasHorariosLocais()
    {
        return $this->hasMany('App\Models\AtividadeDataHorariosLocais', 'idAtividades');
    }

    public function horarios()
    {
        return $this->hasManyThrough('App\Models\Horario', 'App\Models\AtividadeData', 'idAtividades', 'idAtividadesDatas', 'id');
    }
}
