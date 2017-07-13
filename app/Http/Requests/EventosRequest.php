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
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nome' => 'required|unique:eventos',
                    'descricao' => 'required',
                    'dataInicioInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataFimInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataInicio' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataTermino' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'eventosContatos.*' => 'required',
                    'usuariosTipos.*' => 'required',
                    'eventoCaracteristica.eEmiteCertificado' => 'boolean',
                    'eventoCaracteristica.dataLiberacaoCertificado' => 'required_if:eventosCaracteristicas.eEmiteCertificado, true|date_format:"d/m/Y"|after:today',
                    'eventoCaracteristica.eSubmissaoArtigo' => 'boolean',
                    'eventoCaracteristica.eExistemImagens' => 'boolean',
                    'eventoCaracteristica.eExistemNoticias' => 'boolean',
                    'eventoCaracteristica.eAcademico' => 'boolean',
                    'eventoCaracteristica.ePropostaAtividade' => 'boolean',
                    'eventoCaracteristica.eImagemDeFundo' => 'boolean',
                    //'eventoCaracteristica.idAparencias' => 'required',
                    'eventoCaracteristica.logoImagem' => 'required_without:eEventoPai|image|dimensions:min_width=140,min_height=140,max_height=200,max_height=200'
                ];
                break;
            case 'PATCH':
                return [
                    'nome' => 'required|unique:eventos,nome,'.$this->route('id'),
                    'descricao' => 'required',
                    'dataInicioInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataFimInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataInicio' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataTermino' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'eventosContatos.*' => 'required',
                    'eventoCaracteristica.eEmiteCertificado' => 'boolean',
                    'eventoCaracteristica.eSubmissaoArtigo' => 'boolean',
                    'eventoCaracteristica.dataLiberacaoCertificado' => 'required_if:eventosCaracteristicas.eEmiteCertificado, true|date_format:"d/m/Y"|after:today',
                    'eventoCaracteristica.eExistemImagens' => 'boolean',
                    'eventoCaracteristica.eExistemNoticias' => 'boolean',
                    'eventoCaracteristica.eAcademico' => 'boolean',
                    'eventoCaracteristica.ePropostaAtividade' => 'boolean',
                    'eventoCaracteristica.idAparencias' => 'required',
                ];
        }

    }

    public function messages()
    {
        return [
            'eventosCaracteristicas.logoImagem.dimensions' => 'Dimensões permitidas 140x140 até 200x200'
        ];
    }

}
