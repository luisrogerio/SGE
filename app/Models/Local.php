<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected   $fillable   = ['id','nome'];
    protected   $table      = 'locais';
    public      $timestamps = false;

    public function horarios(){
        return $this->belongsToMany('SGE\Models\Horario', 'horarios_locais', 'idLocais', 'idHorarios')->withPivot('criadoEm', 'modificadoEm', 'salvoPor');
    }
}
