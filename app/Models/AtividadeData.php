<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeData extends Model{
    protected   $table      = "atividades_datas";
    protected   $fillable   = ['data', 'idAtividades', 'criadoEm', 'modificadoEm', 'salvoPor'];
    public      $timestamps = false;

    public function horarios(){
        $this->hasMany('SGE\Models\Horario', 'idAtividadesDatas');
    }

    public function atividade(){
        $this->belongsTo('SGE\Models\Atividade', 'idAtividades');
    }
}
