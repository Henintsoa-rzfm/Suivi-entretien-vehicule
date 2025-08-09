<?php

namespace App\Http\Requests\Detenteur;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetenteurRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'MatrDetenteur' => 'required|unique:detenteurs,MatrDetenteur|numeric|digits:6',
            'Detenteur' => 'required|unique:detenteurs,Detenteur',
            'Poste' => 'required'
        ];
    }
}
