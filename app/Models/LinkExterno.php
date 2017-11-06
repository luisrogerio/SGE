<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LinkExterno
 *
 * @property integer $id
 * @property integer $idEventos
 * @property string $descricao
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereIdEventos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereDescricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LinkExterno whereSalvoPor($value)
 * @mixin \Eloquent
 * @property string|null $titulo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LinkExterno whereTitulo($value)
 */
class LinkExterno extends Model
{
    protected $fillable =
        [
            'titulo',
            'descricao',
            'url',
        ];
    protected $table = 'links_externos';

    public function evento()
    {
        $this->belongsTo('App\Models\Evento', 'idEventos');
    }
}
