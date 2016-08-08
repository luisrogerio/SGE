<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCaracteristica extends Model
{
    protected   $table      = 'eventos_caracteristicas';
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
    protected $dates        = [
        'dataLiberacaoCertificado'
    ];
    public $timestamps = false;

    public function evento(){
        return $this->belongsTo('SGE\Models\Evento', 'idEventos');
    }

    public function aparencia(){
        return $this->belongsTo('SGE\Models\Aparencia','idAparencia');
    }

}
