<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unidade
 *
 * @property integer $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $salvoPor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unidade whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unidade whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unidade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unidade whereSalvoPor($value)
 * @mixin \Eloquent
 */
class Unidade extends Model
{
    protected $fillable = [
        'nome'
    ];

    protected $table = 'unidades';
}
