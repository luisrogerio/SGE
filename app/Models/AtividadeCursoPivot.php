<?php
/**
 * Created by PhpStorm.
 * User: luisr
 * Date: 11/08/2017
 * Time: 11:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class AtividadeCursoPivot extends Pivot
{
    protected $dates =
        [
            "dataInicio",
            "dataFim"
        ];
}