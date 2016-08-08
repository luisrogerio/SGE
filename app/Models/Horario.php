<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model{
    protected $table = "horarios";
    protected $fillable = ['inicio', 'termino', 'idAtividadesDatas', 'criadoEm', 'modificadoEm', 'salvoPor'];
    public $timestamps = false;

    public function locais(){
        return $this->belongsToMany('SGE\Models\Local', 'horarios_locais', 'idHorarios', 'idLocais')->withPivot('criadoEm', 'modificadoEm', 'salvoPor');
    }

    public function atividadeData(){
        return $this->belongsTo('SGE\Models\AtividadeData', 'idAtividadesDatas');
    }
}
