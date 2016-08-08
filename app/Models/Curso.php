<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
    protected $table = 'cursos';
    protected $fillable = ['id', 'nome', 'sigla'];
    public $timestamps = false;

    public function atividade(){
        return $this->belongsToMany('SGE\Models\Atividade', 'atividades_cursos', 'idCursos', 'idAtividades');
    }
}
