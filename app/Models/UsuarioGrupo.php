<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsuarioGrupo
 *
 * @property integer $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioGrupo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioGrupo whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioGrupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioGrupo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsuarioGrupo whereSalvoPor($value)
 * @mixin \Eloquent
 */
class UsuarioGrupo extends Model
{
    protected $table = 'usuarios_grupos';
    protected $fillable = ['id', 'nome'];
}
