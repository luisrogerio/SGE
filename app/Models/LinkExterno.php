<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkExterno extends Model
{
    protected   $fillable =
        [
            'descricao' ,
            'url'       ,
        ];
    protected   $table = 'links_externos';

    public function evento(){
        $this->belongsTo('App\Models\Evento','idEventos');
    }
}
