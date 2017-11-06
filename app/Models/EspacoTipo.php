<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EspacoTipo
 *
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $salvoPor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EspacoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EspacoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EspacoTipo whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EspacoTipo whereSalvoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EspacoTipo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EspacoTipo extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'espacos_tipos';
}
