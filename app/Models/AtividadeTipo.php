<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeTipo extends Model
{
    protected   $fillable   = ['id', 'nome'];
    protected   $table      = 'atividades_tipos';
    public      $timestamps = false;

    public function atividade(){
        return $this->belongsToMany('App\Models\Atividade');
    }
}
