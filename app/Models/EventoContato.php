<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventoContato
 *
 * @property integer $id
 * @property string $nome
 * @property string $telefone
 * @property string $celular
 * @property string $email
 * @property string $redesSociais
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property mixed $redessociais
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereTelefone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereCelular($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereRedesSociais($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventoContato whereSalvoPor($value)
 * @mixin \Eloquent
 */
class EventoContato extends Model
{
    protected $table = 'eventos_contatos';
    protected $fillable = [
        'id',
        'idEventos',
        'nome',
        'telefone',
        'celular',
        'email',
        'redesSociais',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];

    public function evento()
    {
        $this->belongsToMany('App\Models\Evento', 'contatos_eventos', 'idEventosContatos', 'idEventos');
    }

    public function getRedessociaisAttribute($value)
    {
        return explode("<br>", $value);
    }

    public function setRedessociaisAttribute($value)
    {
        $this->attributes['redesSociais'] = implode("<br>", $value);
    }
}
