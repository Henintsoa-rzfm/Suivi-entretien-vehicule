<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'PlaqueImmatric' => 'required|max:10',
                'Vehicule' => 'required',
                'Energie' => 'required',
                'Consommation' => 'required|numeric',
                'CV' => 'required|numeric',
                'AnneeMenCirc' => 'required|before_or_equal:today',
                'DateEntree' => 'required|before_or_equal:today',
                'KMActuel' => 'required|numeric',
        ];
    }
}
