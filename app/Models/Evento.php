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

    protected $dates   = [
        'dataInicioInscricao'       ,
        'dataFimInscricao'          ,
        'dataInicio'                ,
        'dataTermino'
    ];


    public function eventoEdicaoAnterior(){
        return $this->belongsTo('App\Models\Evento','idEdicaoAnterior');
    }

    public function eventoEdicaoPosterior(){
        return $this->hasOne('App\Models\Evento','idEdicaoAnterior', 'id');
    }

    public function eventosFilhos(){
        return $this->hasMany('App\Models\Evento','idPai', 'id');
    }

    public function eventoPai(){
        return $this->belongsTo('App\Models\Evento','idPai');
    }

    public function eventoCaracteristica(){
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

    public function tiposDeUsuario(){
        return $this->belongsToMany('App\Models\UsuarioTipo', 'eventos_usuarios_tipos', 'idEventos', 'idUsuariosTipos');
    }

    public function setIdedicaoanteriorAttribute($value){
        $this->attributes['idEdicaoAnterior'] = trim($value) == '' ? null : trim($value);
    }

    public function getEventosPai(){
        $eventosPai = [];
        $eventoAtual = $this;
        while($eventoAtual->eventoPai != null){
            $eventosPai[] = $eventoAtual->eventoPai;
            $eventoAtual = $eventoAtual->eventoPai;
        }
        return array_reverse($eventosPai);
    }

}


