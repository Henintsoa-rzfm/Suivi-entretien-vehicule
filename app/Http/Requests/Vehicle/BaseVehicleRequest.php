<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class BaseVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'PlaqueImmatric' => [
                'required',
                'max:10',
                Rule::unique('vehicules', 'PlaqueImmatric'),
            ],
            'Vehicule' => 'required',
            'Energie' => [
                'required',
                'in:Essence,Diesel',
                function ($attribute, $value, $fail) {
                    // Custom validation for energy-specific constraints
                    if ($this->input('Consommation') > 0) {
                        if ($value === 'Essence' && $this->input('Consommation') > 20) {
                            $fail('La consommation pour un véhicule essence doit être ≤ 20 L/100km.');
                        }
                        if ($value === 'Diesel' && $this->input('Consommation') > 15) {
                            $fail('La consommation pour un véhicule diesel doit être ≤ 15 L/100km.');
                        }
                    }
                }
            ],
            'Consommation' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $energie = $this->input('Energie');
                    if ($energie === 'Essence' && $value > 20) {
                        $fail('La consommation pour un véhicule essence doit être ≤ 20 L/100km.');
                    }
                    if ($energie === 'Diesel' && $value > 15) {
                        $fail('La consommation pour un véhicule diesel doit être ≤ 15 L/100km.');
                    }
                }
            ],
            'CV' => [
                'required',
                'numeric',
                'between:1,1000',
            ],
            'AnneeMenCirc' => [
                'required',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) {
                    if ($value < '1900-01-01') {
                        $fail('L\'année de mise en circulation doit être après le 1er janvier 1900.');
                    }
                }
            ],
            'DateEntree' => [
                'required',
                'date',
                'after:AnneeMenCirc',
                'before_or_equal:today',
                function ($attribute, $value, $fail) {
                    if ($value < '1900-01-01') {
                        $fail('La date d\'entrée doit être après le 1er janvier 1900.');
                    }
                }
            ],
            'KMActuel' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }

    public function messages() : array
    {
        return [
            'PlaqueImmatric.required' => 'Le champ Plaque Immatriculation est obligatoire.',
            'PlaqueImmatric.max' => 'Le champ Plaque Immatriculation ne doit pas dépasser 10 caractères.',
            'PlaqueImmatric.unique' => 'Cette plaque d\'immatriculation est déjà utilisée.',
            'Vehicule.required' => 'Le champ Véhicule est obligatoire.',
            'Energie.required' => 'Le champ Energie est obligatoire.',
            'Energie.in' => 'La valeur de énergie doit être Essence ou Diesel.',
            'Consommation.required' => 'Le champ Consommation est obligatoire.',
            'Consommation.numeric' => 'Le champ Consommation doit être un nombre.',
            'Consommation.min' => 'La consommation ne peut pas être négative.',
            'CV.required' => 'Le champ Puissance est obligatoire.',
            'CV.numeric' => 'Le champ Puissance doit être un nombre.',
            'CV.between' => 'La puissance en CV doit être comprise entre 1 et 1000.',
            'AnneeMenCirc.required' => 'Le champ Année de mise en circulation est obligatoire.',
            'AnneeMenCirc.date' => 'Le champ Année de mise en circulation doit être une date valide.',
            'AnneeMenCirc.before_or_equal' => 'La date de mise en circulation doit être avant ou égale aujourd\'hui.',
            'DateEntree.required' => 'Le champ Date d\'entrée est obligatoire.',
            'DateEntree.date' => 'Le champ Date d\'entrée doit être une date valide.',
            'DateEntree.after' => 'La date d\'entrée doit être après l\'année de mise en circulation.',
            'DateEntree.before_or_equal' => 'La date d\'entrée doit être avant la date d\'aujourd\'hui.',
            'KMActuel.required' => 'Le champ Kilométrage actuel est obligatoire.',
            'KMActuel.numeric' => 'Le champ Kilométrage actuel doit être un nombre.',
            'KMActuel.min' => 'Le kilométrage actuel ne peut pas être négatif.',
        ];
    }
}
