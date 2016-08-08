<?php

namespace SGE\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    protected   $fillable   = ['id','nome'];
    protected   $table      = 'usuarios_tipos';
    public      $timestamps = false;
}
