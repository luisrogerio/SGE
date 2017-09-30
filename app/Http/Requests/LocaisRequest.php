<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocaisRequest extends Request
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
                    'nome' => 'required|unique:locais',
                    'idUnidades' => 'required'
                ];
                break;
            case 'PATCH':
                return [
                    'nome' => 'required|unique:locais,nome,' . $this->route('id')
                ];
                break;
        }
    }
}
