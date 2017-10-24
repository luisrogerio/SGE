<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

/**
 * App\Models\Evento
 *
 * @property integer $id
 * @property integer $idEdicaoAnterior
 * @property integer $idPai
 * @property string $nome
 * @property \Carbon\Carbon $dataInicioInscricao
 * @property \Carbon\Carbon $dataFimInscricao
 * @property \Carbon\Carbon $dataInicio
 * @property \Carbon\Carbon $dataTermino
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @property-read \App\Models\Evento $eventoEdicaoAnterior
 * @property-read \App\Models\Evento $eventoEdicaoPosterior
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Evento[] $eventosFilhos
 * @property-read \App\Models\Evento $eventoPai
 * @property-read \App\Models\EventoCaracteristica $eventoCaracteristica
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventoContato[] $eventosContatos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventoImagem[] $eventosImagens
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventoNoticia[] $eventosNoticias
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LinkExterno[] $linksExternos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Aparencia[] $aparencia
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UsuarioTipo[] $tiposDeUsuario
 * @property-write mixed $idedicaoanterior
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereIdEdicaoAnterior($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereIdPai($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereDataInicioInscricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereDataFimInscricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereDataInicio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereDataTermino($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereDescricao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Evento whereSalvoPor($value)
 * @mixin \Eloquent
 * @property string $nomeSlug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Atividade[] $atividades
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Evento whereNomeSlug($value)
 */
class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = [
        'idEdicaoAnterior',
        'idEventosCaracteristicas',
        'idPai',
        'titulo',
        'nome',
        'nomeSlug',
        'dataInicioInscricao',
        'dataFimInscricao',
        'dataInicio',
        'dataTermino',
        'descricao',
        'comissaoOrganizadora',
        'publicoAlvo',
        'criadoEm',
        'modificadoEm',
        'salvoPor'
    ];

    protected $dates = [
        'dataInicioInscricao',
        'dataFimInscricao',
        'dataInicio',
        'dataTermino'
    ];

    public function atividades(){
        return $this->hasMany('App\Models\Atividade', 'idEventos');
    }

    public function eventoEdicaoAnterior()
    {
        return $this->belongsTo('App\Models\Evento', 'idEdicaoAnterior');
    }

    public function eventoEdicaoPosterior()
    {
        return $this->hasOne('App\Models\Evento', 'idEdicaoAnterior', 'id');
    }

    public function eventosFilhos()
    {
        return $this->hasMany('App\Models\Evento', 'idPai', 'id');
    }

    public function eventoPai()
    {
        return $this->belongsTo('App\Models\Evento', 'idPai');
    }

    public function eventoCaracteristica()
    {
        return $this->hasOne('App\Models\EventoCaracteristica', 'idEventos');
    }

    public function eventosContatos()
    {
        return $this->belongsToMany('App\Models\EventoContato', 'contatos_eventos', 'idEventos', 'idEventosContatos');
    }

    public function eventosImagens()
    {
        return $this->hasMany('App\Models\EventoImagem', 'idEventos');
    }

    public function eventosNoticias()
    {
        return $this->hasMany('App\Models\EventoNoticia', 'idEventos');
    }

    public function linksExternos()
    {
        return $this->hasMany('App\Models\LinkExterno', 'idEventos');
    }

    public function aparencia()
    {
        return $this->hasManyThrough('App\Models\Aparencia', 'App\Models\EventoCaracteristica',
            'idEventos', 'idEventosCaracteristicas', 'id'
        );
    }

    public function tiposDeUsuario()
    {
        return $this->belongsToMany('App\Models\UsuarioTipo', 'eventos_usuarios_tipos', 'idEventos', 'idUsuariosTipos');
    }

    public function setIdedicaoanteriorAttribute($value)
    {
        $this->attributes['idEdicaoAnterior'] = trim($value) == '' ? null : trim($value);
    }

    public function participantes()
    {
        return $this->belongsToMany('App\Models\Usuario', 'eventos_participantes', 'idEventos', 'idUsuarios');
    }

    public function isParticipante($id)
    {
        $participante = Usuario::findOrFail($id);
        return (bool) $this->participantes()->get()->contains($participante);
    }

    public function getEventosPai()
    {
        $eventosPai = [];
        $eventoAtual = $this;
        while ($eventoAtual->eventoPai != null) {
            $eventosPai[] = $eventoAtual->eventoPai;
            $eventoAtual = $eventoAtual->eventoPai;
        }
        return array_reverse($eventosPai);
    }

}


