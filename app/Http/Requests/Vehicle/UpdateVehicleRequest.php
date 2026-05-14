<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'Energie' => 'required|in:Essence,Diesel',
            'Consommation' => 'required|numeric',
            'CV' => 'required|numeric',
            'AnneeMenCirc' => 'required|date|before_or_equal:today',
            'DateEntree' => 'required|date|after:AnneeMenCirc|before_or_equal:today',
            'KMActuel' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'Energie.in' => 'La valeur de energie doit être Essence ou Diesel',
            'AnneeMenCirc.before_or_equal' => 'La date de mise en circulation doît être avant ou égale aujourd\'hui',
            'DateEntree.after' => "La date d'entrée doit être après l'année de mise en circulation ",
            'DateEntree.before_or_equal' => "La date d'entrée doit être avant la date d'aujourd'hui",
        ];
    }
}
