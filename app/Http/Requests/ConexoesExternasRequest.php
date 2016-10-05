<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConexoesExternasRequest extends Request
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
            'driver' => 'required',
            'host' => 'required',
            'database' => 'required',
            'view' => 'required',
            'login' => 'required',
            'senha' => 'required'
        ];
    }
}