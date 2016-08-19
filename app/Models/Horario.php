<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model{
    protected $table = "horarios";
    protected $fillable = ['inicio', 'termino', 'idAtividadesDatas', 'criadoEm', 'modificadoEm', 'salvoPor'];

    public function locais(){
        return $this->belongsToMany('App\Models\Local', 'horarios_locais', 'idHorarios', 'idLocais')->withPivot('criadoEm', 'modificadoEm', 'salvoPor');
    }

    public function atividadeData(){
        return $this->belongsTo('App\Models\AtividadeData', 'idAtividadesDatas');
    }
}
