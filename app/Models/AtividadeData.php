<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeData extends Model{
    protected   $table      = "atividades_datas";
    protected   $fillable   = ['data', 'idAtividades', 'criadoEm', 'modificadoEm', 'salvoPor'];

    public function horarios(){
        $this->hasMany('App\Models\Horario', 'idAtividadesDatas');
    }

    public function atividade(){
        $this->belongsTo('App\Models\Atividade', 'idAtividades');
    }
}
