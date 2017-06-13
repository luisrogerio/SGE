<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'nome'
    ];

    protected $table = 'salas';

    public function local()
    {
        return $this->belongsTo('App\Models\Local', 'idLocais');
    }
}
