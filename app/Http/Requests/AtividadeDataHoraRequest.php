<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AtividadeDataHoraRequest extends Request
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
        return [
            'data' => 'required|date_format:"d/m/Y"',
            'horarioInicio' => 'required|date_format:"H:i"',
            'horarioTermino' => 'required|date_format:"H:i"',
        ];
    }
}
