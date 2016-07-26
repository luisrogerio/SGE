<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCaracteristica extends Model
{
    protected   $table      = 'EventosCaracteristicas';
    protected   $fillable   = [
        'id'                        ,
		'idAparencias'              ,
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

    public function evento(){
        $this->belongsTo('App\Models\Evento', 'idEventosCaracteristicas');
    }

    public function aparencia(){
        $this->belongsTo('App\Models\Aparencia','idAparencia');
    }

}
