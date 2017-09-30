<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventoCaracteristica
 *
 * @property integer $id
 * @property integer $idAparencias
 * @property integer $idEventos
 * @property boolean $eImagemDeFundo
 * @property string $background
 * @property string $backgroundColor
 * @property boolean $eEmiteCertificado
 * @property \Carbon\Carbon $dataLiberacaoCertificado
 * @property boolean $eExistemImagens
 * @property string $eExistemNoticias
 * @property string $favicon
 * @property string $logo
 * @property boolean $eAcademico
 * @property boolean $ePropostaAtividade
 * @property boolean $eSubmissaoArtigo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\Evento $evento
 * @property-read \App\Models\Aparencia $aparencia
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereIdAparencias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereIdEventos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEImagemDeFundo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereBackground($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereBackgroundColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEEmiteCertificado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereDataLiberacaoCertificado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEExistemImagens($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEExistemNoticias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereFavicon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEAcademico($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereEPropostaAtividade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereESubmissaoArtigo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoCaracteristica whereSalvoPor($value)
 * @mixin \Eloquent
 */
class EventoCaracteristica extends Model
{
    protected $table = 'eventos_caracteristicas';
    protected $fillable = [
        'id',
        'idAparencias',
        'eImagemDeFundo',
        'background',
        'backgroundColor',
        'eEmiteCertificado',
        'dataLiberacaoCertificado',
        'eExistemImagens',
        'eExistemNoticias',
        'favicon',
        'logo',
        'ePropostaAtividade',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];

    protected $dates = [
        'dataLiberacaoCertificado'
    ];

    public function evento()
    {
        return $this->belongsTo('App\Models\Evento', 'idEventos');
    }

    public function aparencia()
    {
        return $this->belongsTo('App\Models\Aparencia', 'idAparencia');
    }

}
