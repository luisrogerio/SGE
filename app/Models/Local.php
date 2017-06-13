<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected   $fillable   = ['id','nome'];
    protected   $table      = 'locais';

    public function unidade(){
        return $this->belongsTo('App\Models\Unidade', 'idUnidades');
    }
}
