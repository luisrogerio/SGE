<?php

namespace SGE\Http\Requests;

use SGE\Http\Requests\Request;

class CursosRequest extends Request
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
            'nome' => 'required|',
            'sigla' => 'required|max:10'
        ];
    }
}
