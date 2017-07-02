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
        'salvoPor'
    ];

    public function tipoDeAtividade()
    {
        return $this->belongsTo('App\Models\AtividadeTipo', 'idAtividadesTipos');
    }

    public function evento()
    {
        return $this->belongsTo('App\Models\Evento', 'idEventos');
    }

    public function statusDeAtividade()
    {
        return $this->belongsToMany('App\Models\AtividadeStatus', 'atividades_atividades_status', 'idAtividades', 'idAtividadesStatus')->withPivot('observacao');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Models\Curso', 'atividades_cursos', 'idAtividades', 'idCursos')->withPivot('dataInicio', 'dataFim');
    }

//    public function atividadesDatas(){
//        return $this->hasMany('App\Models\AtividadeData', 'idAtividades');
//    }

    public function atividadesDatasHoras()
    {
        return $this->hasMany('App\Models\AtividadeDataHora', 'idAtividades');
    }

//    public function horarios()
//    {
//        return $this->hasManyThrough('App\Models\Horario', 'App\Models\AtividadeData', 'idAtividades', 'idAtividadesDatas', 'id');
//    }
}
