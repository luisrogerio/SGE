<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioGrupo extends Model{
    protected $table = 'usuarios_grupos';
    protected $fillable = ['id', 'nome'];
    public $timestamps = false;
}
