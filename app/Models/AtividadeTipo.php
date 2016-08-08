<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeTipo extends Model
{
    protected   $fillable   = ['id', 'nome'];
    protected   $table      = 'atividades_tipos';
    public      $timestamps = false;

    public function atividade(){
        return $this->hasMany('SGE\Models\Atividade');
    }
}
