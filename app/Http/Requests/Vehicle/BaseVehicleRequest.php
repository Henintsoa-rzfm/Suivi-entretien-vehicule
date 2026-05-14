<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseVehicleRequest extends FormRequest
{
    public function messages() : array
    {
        return [
            'PlaqueImmatric.required' => 'Le champ Plaque Immatriculation est obligatoire.',
            'PlaqueImmatric.max' => 'Le champ Plaque Immatriculation ne doit pas dépasser 10 caractères.',
            'Vehicule.required' => 'Le champ Véhicule est obligatoire.',
            'Energie.required' => 'Le champ Energie est obligatoire.',
            'Energie.in' => 'La valeur de energie doit être Essence ou Diesel',
            'Consommation.required' => 'Le champ Consommation est obligatoire.',
            'Consommation.numeric' => 'Le champ Consommation doit être un nombre.',
            'CV.required' => 'Le champ Puissance est obligatoire.',
            'CV.numeric' => 'Le champ Puissance doit être un nombre.',
            'AnneeMenCirc.required' => 'Le champ Année de mise en circulation est obligatoire.',
            'AnneeMenCirc.date' => 'Le champ Année de mise en circulation doit être une date valide.',
            'AnneeMenCirc.before_or_equal' => 'La date de mise en circulation doît être avant ou égale aujourd\'hui',
            'DateEntree.required' => 'Le champ Date d\'entrée est obligatoire.',
            'DateEntree.date' => 'Le champ Date d\'entrée doit être une date valide.',
            'DateEntree.after' => 'La date d\'entrée doit être après l\'année de mise en circulation',
            'DateEntree.before_or_equal' => 'La date d\'entrée doit être avant la date d\'aujourd\'hui',
            'KMActuel.required' => 'Le champ Kilométrage actuel est obligatoire.',
            'KMActuel.numeric' => 'Le champ Kilométrage actuel doit être un nombre.',
        ];
    }
}
