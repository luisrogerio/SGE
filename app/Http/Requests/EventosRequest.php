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
            'eventosContatos.*' => 'required',
            'eventosCaracteristicas.eEmiteCertificado' => 'required',
            'eventosCaracteristicas.dataLiberacaoCertificado' => 'required|date',
            'eventosCaracteristicas.eExistemImagens' => 'required',
            'eventosCaracteristicas.eExistemNoticias' => 'required',
            'eventosCaracteristicas.eAcademico' => 'required',
            'eventosCaracteristicas.ePropostaAtividade' => 'required',
            'eventosCaracteristicas.idAparencias' => 'required',
            'eventosCaracteristicas.logoImagem' => 'required|image|dimensions:min_width=140,min_height=140,max_height=200,max_height=200'
        ];
    }

    public function messages()
    {
        return [
            'eventosCaracteristicas.logoImagem.dimensions' => 'Dimensões permitidas 140x140 até 200x200'
        ];
    }

}
