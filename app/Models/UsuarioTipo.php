<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    protected   $fillable   = ['id','nome'];
    protected   $table      = 'usuarios_tipos';

    public function conexaoExterna(){
        return $this->hasOne('App\Models\ConexaoExterna', 'idUsuariosTipos');
    }

    public function configurarConexao(){
        \Config::set('database.connections.'.$this->nome, array(
            'driver'    => $this->conexaoExterna->driver,
            'host'      => $this->conexaoExterna->host,
            'username'  => $this->conexaoExterna->login,
            'password'  => $this->conexaoExterna->senha,
            'database'  => 'conexao'.$this->nome
        ));
    }
}
