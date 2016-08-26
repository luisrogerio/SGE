<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\CanResetPassword
{
    use Authenticatable, CanResetPassword;
    protected $table = 'usuarios';
    protected $fillable = [
        'nome'              ,
        'email'             ,
        'dataNascimento'    ,
        'login'             ,
        'senha'             ,
        'idCursos'          ,
        'idUsuariosTipos'   ,
    ];
    protected $dates = [
        'dataNascimento'
    ];

    public function usuarioTipo(){
        return $this->belongsTo('App\Models\UsuarioTipo', 'idUsuariosTipos');
    }

    public function usuariosGrupos(){
        return $this->belongsToMany('App\Models\UsuarioGrupo', 'usuarios_usuarios_grupos',
            'idUsuarios', 'idUsuariosGrupos');
    }

    public function getAuthPassword(){
        return $this->senha;
    }
}
