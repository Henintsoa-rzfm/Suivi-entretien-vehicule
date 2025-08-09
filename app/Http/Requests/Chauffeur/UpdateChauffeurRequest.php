<?php

namespace App\Http\Requests\Chauffeur;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChauffeurRequest extends FormRequest
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
            'MatrCh' => 'required|numeric|digits:6',
            'Chauffeur' => 'required',
        ];
    }
}
