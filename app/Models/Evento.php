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
        'dataTermino'               ,
        'descricao'                 ,
        'criadoEm'                  ,
        'modificadoEm'              ,
        'salvoPor'
    ];

    public $timestamps = false;

    public function eventoEdicaoAnterior(){
        return $this->hasOne('App\Models\Evento','idEdicaoAnterior', 'id');
    }

    public function eventoEdicaoPosterior(){
        return $this->belongsTo('App\Models\Evento','idEdicaoAnterior');
    }

    public function eventosFilhos(){
        return $this->hasOne('App\Models\Evento','idPai', 'id');
    }

    public function eventoPai(){
        return $this->belongsTo('App\Models\Evento','idPai');
    }

    public function eventosCaractiristicas(){
        return $this->hasOne('App\Models\EventoCaracteristica', 'idEventos');
    }

    public function eventosContatos(){
        return $this->belongsToMany('App\Models\EventoContato', 'contatos_eventos', 'idEventos', 'idEventosContatos');
    }

    public function eventosImagens(){
        return $this->hasMany('App\Models\EventoImagem','idEventos');
    }

    public function eventosNoticias(){
        return $this->hasMany('App\Models\EventoNoticia', 'idEventos');
    }

    public function aparencia(){
        return $this->hasManyThrough('App\Models\Aparencia', 'App\Models\EventoCaracteristica',
            'idEventos', 'idEventosCaracteristicas', 'id'
        );
    }

}


