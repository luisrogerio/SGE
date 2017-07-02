<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AtividadeResponsavel
 *
 * @property int $id
 * @property int $idAtividades
 * @property string $nome
 * @property string|null $titulacao
 * @property string|null $instituicaoOrigem
 * @property string|null $experienciaProfissional
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $salvoPor
 * @property-read \App\Models\Atividade $atividade
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereExperienciaProfissional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereIdAtividades($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereInstituicaoOrigem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereSalvoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereTitulacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AtividadeResponsavel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AtividadeResponsavel extends Model
{
    protected $table = 'atividades_responsaveis';
    protected $fillable = [
        'idAtividades',
        'nome',
        'titulacao',
        'instituicaoOrigem',
        'experienciaProfissional'
    ];

    public function atividade()
    {
        return $this->belongsTo('App\Models\Atividade', 'idAtividades');
    }
}
