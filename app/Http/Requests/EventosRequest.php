<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventosRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'eventos.nome' => 'required',
            'eventos.descricao' => 'required',
            'eventos.dataInicioInscricao' => 'required|date',
            'eventos.dataFimInscricao' => 'required|date',
            'eventos.dataInicio' => 'required|date',
            'eventos.dataTermino' => 'required|date',
            'eventosContatos' => 'required',
            'eventosCaracteristicas.eEmiteCertificado' => 'required',
            'eventosCaracteristicas.dataLiberacaoCertificado' => 'required|date',
            'eventosCaracteristicas.eExistemImagens' => 'required',
            'eventosCaracteristicas.eExistemNoticias' => 'required',
            'eventosCaracteristicas.eAcademico' => 'required',
            'eventosCaracteristicas.ePropostaAtividade' => 'required',
            'eventosCaracteristicas.idAparencias' => 'required'
        ];
    }
}
