<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AtividadeResponsavelRequest extends Request
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
        $rules = [
            'idAtividade.*' => 'required|numeric'
        ];
        foreach($this->request->get('salvar') as $key => $value){
            $rules['nome.'.$key] = 'requiredIf:salvar.'.$key.", 1";
            $rules['titulacao.'.$key] = 'requiredIf:salvar.'.$key.", 1";
            $rules['instituicaoOrigem.'.$key] = 'requiredIf:salvar.'.$key.", 1";
            $rules['experienciaProfissional.'.$key] = 'requiredIf:salvar.'.$key.", 1";
            $rules['instituicaoOrigem.'.$key] = 'requiredIf:salvar.'.$key.", 1";
        }

        return $rules;
    }
}
