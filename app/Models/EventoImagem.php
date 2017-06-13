<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
