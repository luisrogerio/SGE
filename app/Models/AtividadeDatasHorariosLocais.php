<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeDatasHorariosLocais extends Model
{
    protected $table = "atividades_datas_horarios_locais";
    protected $fillable = ['data', 'horarioInicio', 'horarioTermino', 'idLocais', 'idAtividades', 'criadoEm', 'modificadoEm', 'salvoPor'];

    public function atividade()
    {
        $this->belongsTo('App\Models\Atividade', 'idAtividades');
    }

    public function local()
    {
        $this->hasOne('App\Models\Local', 'idLocais');
    }
}
