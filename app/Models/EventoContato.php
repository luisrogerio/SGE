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
        $this->belongsTo('App\Models\Evento','idEvento');
    }
}
