<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AtividadesRequest extends Request
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
                    'nome' => 'required',
                    'quantidadeVagas' => 'required|numeric',
                    'idAtividadesTipos' => 'required',
                    'descricao' => 'required',
//                    'funcaoResponsavel' => 'required',
                    'atividades.quantidadeResponsaveis' => 'required|numeric',
//                    'atividades.idCursos' => 'required',

//                    'comentarios.*' => 'required',

//                    'atividades.unidades' => 'required',
//                    'atividades.locais' => 'required',
//                    'atividades.salas' => 'required',

                    'atividades.data.*' => 'required|date_format:"d/m/Y"',
                    'atividades.horarioInicio.*' => 'required|date_format:"H:i"',
                    'atividades.horarioTermino.*' => 'required|date_format:"H:i"',
                ];
                break;
            case 'PATCH':
                return [
                    'nome' => 'required',
                    'quantidadeVagas' => 'required|numeric',
                    'idAtividadesTipos' => 'required',
                    'descricao' => 'required',
                    //'atividades.idCursos.*' => 'required',

                    'atividades.unidades' => 'required',
                    'atividades.locais' => 'required',
                    'atividades.salas' => 'required',
                ];
                break;
        }

    }
}
