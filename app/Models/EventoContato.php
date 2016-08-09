<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoContato extends Model
{
    public      $timestamps = false;
    protected   $table      = 'eventos_contatos';
    protected   $fillable   = [
        'id'            ,
        'idEventos'     ,
        'nome'          ,
        'telefone'      ,
        'celular'       ,
        'email'         ,
        'redesSociais'  ,
        'criadoEm'      ,
        'modificadoEm'  ,
        'salvoPor'
    ];

    public function evento(){
        $this->belongsToMany('App\Models\Evento', 'contatos_eventos', 'idEventosContatos', 'idEventos');
    }

    public function getRedessociaisAttribute($value){
        return explode("<br>", $value);
    }

    public function setRedessociaisAttribute($value) {
        $this->attributes['redesSociais'] = implode("<br>", $value);
    }
}
