<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsuarioTipo
 *
 * @property integer $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioTipo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioTipo whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioTipo whereSalvoPor($value)
 * @mixin \Eloquent
 */
class UsuarioTipo extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'usuarios_tipos';

}
