<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Local
 *
 * @property integer $id
 * @property integer $idUnidades
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\Unidade $unidade
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereIdUnidades($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Local whereSalvoPor($value)
 * @mixin \Eloquent
 */
class Local extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'locais';

    public function unidade()
    {
        return $this->belongsTo('App\Models\Unidade', 'idUnidades');
    }

    public function salas()
    {
        return $this->hasMany('App\Models\Sala', 'idLocais');
    }
}
