<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class EventoImagem extends Model
{
    public      $timestamps = false;
    protected   $table      = 'eventos_imagens';
    protected   $fillable   = [
        'id'            ,
        'idEventos'     ,
        'imagem'          ,
        'thumbnail'      ,
        'criadoEm'      ,
        'modificadoEm'  ,
        'salvoPor'
    ];

    public function evento(){
        $this->belongsTo('SGE\Models\Evento','idEvento');
    }
}
