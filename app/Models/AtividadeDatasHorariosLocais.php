<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeDatasHorariosLocais extends Model
{
    protected   $table      = "atividades_datas_horarios_locais";
    protected   $fillable   = ['data','horarioInicio', 'horarioTermino', 'idLocais', 'idAtividades', 'criadoEm', 'modificadoEm', 'salvoPor'];
    public      $timestamps = false;

    public function atividade(){
        $this->belongsTo('SGE\Models\Atividade', 'idAtividades');
    }

    public function local(){
        $this->hasOne('SGE\Models\Local', 'idLocais');
    }
}
