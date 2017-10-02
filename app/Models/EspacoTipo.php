<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspacoTipo extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'espacos_tipos';
}
