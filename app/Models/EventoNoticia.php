<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventoNoticia
 *
 * @property integer $id
 * @property integer $idEventos
 * @property string $preview
 * @property string $titulo
 * @property string $noticia
 * @property string $dataHoraPublicacao
 * @property string $dataHoraInicio
 * @property string $dataHoraFim
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereIdEventos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia wherePreview($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereTitulo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereNoticia($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereDataHoraPublicacao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereDataHoraInicio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereDataHoraFim($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoNoticia whereSalvoPor($value)
 * @mixin \Eloquent
 */
class EventoNoticia extends Model
{
    protected $table = 'eventos_noticias';
    protected $fillable = [
        'id',
        'idEventos',
        'preview',
        'titulo',
        'noticia',
        'dataHoraPublicacao',
        'dataHoraInicio',
        'dataHoraFim',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];

    public function evento()
    {
        $this->belongsTo('App\Models\Evento', 'idEventos');
    }
}
