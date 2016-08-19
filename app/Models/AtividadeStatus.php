<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeStatus extends Model{
    protected $table = 'atividades_status';
    protected $fillable = ['id', 'nome'];
}
