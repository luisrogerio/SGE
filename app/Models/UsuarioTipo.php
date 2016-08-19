<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    protected   $fillable   = ['id','nome'];
    protected   $table      = 'usuarios_tipos';
}
