<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'nome'
    ];

    protected $table = 'unidades';
}
