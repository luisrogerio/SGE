<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConexaoExterna extends Model
{
    protected $table = 'conexoes_externas';
    protected $fillable = [
        'driver'    ,
        'host'      ,
        'database'  ,
        'view'      ,
        'login'     ,
        'senha'
    ];

    public function usuarioTipo(){
        return $this->belongsTo('App\Models\UsuarioTipo', 'idUsuariosTipos');
    }
}
