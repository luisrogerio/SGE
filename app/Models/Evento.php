<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table    = 'eventos';
    protected $fillable = [
        'idEdicaoAnterior'          ,
        'idEventosCaracteristicas'  ,
        'idPai'                     ,
        'nome'                      ,
        'dataInicioInscricao'       ,
        'dataFimInscricao'          ,
        'dataInicio'                ,
        'dataFim'                   ,
        'descricao'                 ,
        'criadoEm'                  ,
        'modificadoEm'              ,
        'salvoPor'
    ];

    public $timestamps = false;

    public function eventoEdicaoAnterior(){
        $this->hasOne('App\Models\Evento','idEdicaoAnterior', 'id');
    }

    public function eventoEdicaoPosterior(){
        $this->belongsTo('App\Models\Evento','idEdicaoAnterior');
    }

    public function eventosFilhos(){
        $this->hasOne('App\Models\Evento','idPai', 'id');
    }

    public function eventoPai(){
        $this->belongsToMany('App\Models\Evento','idPai');
    }

    public function eventosCaractiristicas(){
        $this->belongsTo('App\Models\EventoCaracteristica','idEventosCaracteristicas' );
    }

    public function eventosContatos(){
        $this->hasMany('App\Models\EventoContato','idEventos');
    }

    public function eventosImagens(){
        $this->hasMany('App\Models\EventoImagem','idEventos');
    }

    public function eventosNoticias(){
        $this->hasMany('App\Models\EventoNoticia', 'idEventos');
    }

}


