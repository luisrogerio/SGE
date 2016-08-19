<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCaracteristica extends Model
{
    protected   $table      = 'eventos_caracteristicas';
    protected   $fillable   = [
        'id'                        ,
		'idAparencias'              ,
        'eImagemDeFundo'            ,
		'background'                ,
		'backgroundColor'           ,
		'eEmiteCertificado'         ,
		'dataLiberacaoCertificado'  ,
		'eExistemImagens'           ,
		'eExistemNoticias'          ,
		'favicon'                   ,
		'logo'                      ,
		'eAcademico'                ,
		'ePropostaAtividade'        ,
		'criadoEm'                  ,
		'modificadoEm'              ,
		'salvoPor'
    ];

    protected $dates        = [
        'dataLiberacaoCertificado'
    ];

    public function evento(){
        return $this->belongsTo('App\Models\Evento', 'idEventos');
    }

    public function aparencia(){
        return $this->belongsTo('App\Models\Aparencia','idAparencia');
    }

}
