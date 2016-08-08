<?php

namespace SGE\Models;

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
    public $timestamps = false;

    public function atividadesTipos(){
        return $this->belongsTo('SGE\Models\AtividadeTipo', 'idAtividadesTipos');
    }

    public function cursos(){
        return $this->belongsToMany('SGE\Models\Curso', 'atividades_cursos', 'idAtividades', 'idCursos');
    }

//    public function atividadesDatas(){
//        return $this->hasMany('SGE\Models\AtividadeData', 'idAtividades');
//    }

    public function atividadesDatasHorariosLocais(){
        return $this->hasMany('SGE\Models\AtividadeDataHorariosLocais', 'idAtividades');
    }

    public function horarios(){
        return $this->hasManyThrough('SGE\Models\Horario', 'SGE\Models\AtividadeData', 'idAtividades', 'idAtividadesDatas', 'id');
    }
}
