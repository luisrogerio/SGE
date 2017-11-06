<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Usuario
 *
 * @property integer $id
 * @property integer $idCursos
 * @property integer $idUsuariosTipos
 * @property string $nome
 * @property string $email
 * @property \Carbon\Carbon $dataNascimento
 * @property string $login
 * @property string $senha
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\UsuarioTipo $usuarioTipo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UsuarioGrupo[] $usuariosGrupos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereIdCursos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereIdUsuariosTipos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereDataNascimento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereSenha($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Usuario whereSalvoPor($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Atividade[] $atividades
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Evento[] $eventos
 */
class Usuario extends Model implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\CanResetPassword
{
    use Authenticatable, CanResetPassword;
    protected $table = 'usuarios';
    protected $fillable = [
        'id',
        'nome',
        'email',
        'dataNascimento',
        'login',
        'senha',
        'idCursos',
        'idUsuariosTipos',
    ];
    protected $dates = [
        'dataNascimento'
    ];

    public function usuarioTipo()
    {
        return $this->belongsTo('App\Models\UsuarioTipo', 'idUsuariosTipos');
    }

    public function atividades()
    {
        return $this->belongsToMany('App\Models\Atividade', 'atividades_participantes',
            'idUsuarios', 'idAtividades');
    }

    public function usuariosGrupos()
    {
        return $this->belongsToMany('App\Models\UsuarioGrupo', 'usuarios_usuarios_grupos',
            'idUsuarios', 'idUsuariosGrupos');
    }

    public function eventos()
    {
        return $this->belongsToMany('App\Models\Evento', 'eventos_participantes', 'idUsuarios', 'idEventos');
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function temPapel($papel){
        $grupos = $this->usuariosGrupos;
        if($papel == 'root'){
            $papel = 'Root';
        }
        if($papel == 'admin'){
            $papel = 'Administrador';
        }
        return $grupos->contains('nome', $papel);
    }
}
