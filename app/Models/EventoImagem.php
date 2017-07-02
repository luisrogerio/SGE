<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventoImagem
 *
 * @property integer $id
 * @property integer $idEventos
 * @property string $imagem
 * @property string $thumbnail
 * @property string $dataDaImagem
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereIdEventos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereImagem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereThumbnail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereDataDaImagem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereDescricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoImagem whereSalvoPor($value)
 * @mixin \Eloquent
 */
class EventoImagem extends Model
{
    protected $table = 'eventos_imagens';
    protected $fillable = [
        'id',
        'idEventos',
        'imagem',
        'thumbnail',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];

    public function evento()
    {
        $this->belongsTo('App\Models\Evento', 'idEventos');
    }
}
