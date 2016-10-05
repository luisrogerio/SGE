<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model{
    protected $table = 'alunos';
    protected $fillable = [
        'id'                ,
        'nome'              ,
        'dataDeNascimento'  ,
        'cpf'               ,
        'rg'                ,
        'nomeDoPai'         ,
        'nomeDaMae'         ,
        'idCursos'
    ];
    protected $dates = [
        'dataDeNascimento'
    ];

    protected $dateFormat = "d/m/Y";

    public function checarCadastro($matricula, $cpf){
        Aluno::setConnection('Aluno');
        return Aluno::where(array(['id', 'LIKE', $matricula], ['cpf', 'LIKE', $cpf]));
    }
}
