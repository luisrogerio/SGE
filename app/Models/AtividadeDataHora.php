<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeDatasHora extends Model
{
    protected $table = "atividades_datas_horarios_locais";
    protected $fillable =
        [
            'data',
            'horarioInicio',
            'horarioTermino',
            'idUnidades',
            'idLocais',
            'idSalas',
            'idAtividades',
            'salvoPor'
        ];

    public function atividade()
    {
        $this->belongsTo('App\Models\Atividade', 'idAtividades');
    }

    public function local()
    {
        $this->hasOne('App\Models\Local', 'idLocais');
    }
}
