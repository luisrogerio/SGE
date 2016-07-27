<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoNoticia extends Model
{
    public      $timestamps = false;
    protected   $table      = 'eventos_noticias';
    protected   $fillable   = [
        'id'                    ,
        'idEventos'             ,
        'preview'               ,
        'titulo'                ,
        'noticia'               ,
        'dataHoraPublicacao'    ,
        'dataHoraInicio'        ,
        'dataHoraFim'           ,
        'criadoEm'              ,
        'modificadoEm'          ,
        'salvoPor'
    ];

    public function evento(){
        $this->belongsTo('App\Models\Evento','idEvento');
    }
}
