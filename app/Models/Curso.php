<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
    protected $table = 'cursos';
    protected $fillable = ['id', 'nome', 'sigla'];
    public $timestamps = false;

    public function atividade(){
        return $this->belongsToMany('App\Models\Atividade', 'atividades_cursos', 'idCursos', 'idAtividades');
    }
}
