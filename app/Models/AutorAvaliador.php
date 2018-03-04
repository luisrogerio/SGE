<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutorAvaliador extends Model
{
    protected $table = 'autores_avaliadores';
    protected $fillable = ['presenca', 'apresentacao'];
    public $timestamps = false;

    public function academicos()
    {
        return $this->belongsTo('App\Models\Usuario', 'idUser', 'id');
    }

    public function evento()
    {
        return $this->belongsTo('App\Models\Evento', 'evento_id', 'id');
    }

    public function scopeTrabalhosPresente($query, $id)
    {
        return $query
            ->where("idUser", "=", $id)
            ->where(function ($query) {
                $query->where("presenca", "=", true)
                    ->orWhere("relacaoTrabalho", "=", 2);
            });
    }
}
