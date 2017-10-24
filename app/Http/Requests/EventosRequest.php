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
                if ($this->route('idPai') == 0) {
                    return [
                        'titulo' => 'required',
                        'nome' => 'required|unique:eventos',
                        'descricao' => 'required',
                        'dataInicioInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataFimInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataInicio' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataTermino' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'eventosContatos.*' => 'required',
                        'comissaoOrganizadora' => 'required',
                        'publicoAlvo' => 'required',
                        'usuariosTipos.*' => 'required',
                        'eventoCaracteristica.eEmiteCertificado' => 'boolean',
                        'eventoCaracteristica.dataLiberacaoCertificado' => 'required_if:eventosCaracteristicas.eEmiteCertificado, true|date_format:"d/m/Y"|after:today',
                        'eventoCaracteristica.eExistemImagens' => 'boolean',
                        'eventoCaracteristica.eExistemNoticias' => 'boolean',
                        'eventoCaracteristica.ePropostaAtividade' => 'boolean',
                        'eventoCaracteristica.eImagemDeFundo' => 'boolean',
                        'eventoCaracteristica.logoImagem' => 'required_without:eEventoPai|image|dimensions:min_width=100,min_height=100,max_height=200,max_height=200'
                    ];
                } else {
                    return [
                        'titulo' => 'required',
                        'nome' => 'required|unique:eventos',
                        'descricao' => 'required',
                        'dataInicioInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataFimInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataInicio' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'dataTermino' => 'required|date_format:"d/m/Y H:i"|after:today',
                        'eventosContatos.*' => 'required'
                    ];
                }
                break;
            case 'PATCH':
                return [
                    'titulo' => 'required',
                    'nome' => 'required|unique:eventos,nome,'.$this->route('id'),
                    'descricao' => 'required',
                    'dataInicioInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataFimInscricao' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataInicio' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'dataTermino' => 'required|date_format:"d/m/Y H:i"|after:today',
                    'eventosContatos.*' => 'required',
                    'eventoCaracteristica.eEmiteCertificado' => 'boolean',
                    'eventoCaracteristica.dataLiberacaoCertificado' => 'required_if:eventosCaracteristicas.eEmiteCertificado, true|date_format:"d/m/Y"|after:today',
                    'eventoCaracteristica.eExistemImagens' => 'boolean',
                    'eventoCaracteristica.eExistemNoticias' => 'boolean',
                    'eventoCaracteristica.ePropostaAtividade' => 'boolean'
                ];
        }

    }

    public function messages()
    {
        return [
            'eventoCaracteristica.logoImagem.dimensions' => 'Dimensões permitidas 100px/100px até 200px/200px'
        ];
    }

}
