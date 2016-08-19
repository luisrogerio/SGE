<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioGrupo extends Model{
    protected $table = 'usuarios_grupos';
    protected $fillable = ['id', 'nome'];
}
