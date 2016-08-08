<?php

namespace SGE\Models;

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

    protected $dates   = [
        'dataInicioInscricao'       ,
        'dataFimInscricao'          ,
        'dataInicio'                ,
        'dataTermino'
    ];

    public $timestamps = false;

    public function eventoEdicaoAnterior(){
        return $this->hasOne('SGE\Models\Evento','idEdicaoAnterior', 'id');
    }

    public function eventoEdicaoPosterior(){
        return $this->belongsTo('SGE\Models\Evento','idEdicaoAnterior');
    }

    public function eventosFilhos(){
        return $this->hasOne('SGE\Models\Evento','idPai', 'id');
    }

    public function eventoPai(){
        return $this->belongsTo('SGE\Models\Evento','idPai');
    }

    public function eventoCaracteristica(){
        return $this->hasOne('SGE\Models\EventoCaracteristica', 'idEventos');
    }

    public function eventosContatos(){
        return $this->belongsToMany('SGE\Models\EventoContato', 'contatos_eventos', 'idEventos', 'idEventosContatos');
    }

    public function eventosImagens(){
        return $this->hasMany('SGE\Models\EventoImagem','idEventos');
    }

    public function eventosNoticias(){
        return $this->hasMany('SGE\Models\EventoNoticia', 'idEventos');
    }

    public function aparencia(){
        return $this->hasManyThrough('SGE\Models\Aparencia', 'SGE\Models\EventoCaracteristica',
            'idEventos', 'idEventosCaracteristicas', 'id'
        );
    }

}


