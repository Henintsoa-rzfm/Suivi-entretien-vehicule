<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = ['PlaqueImmatric', 'Vehicule', 'Energie', 'Consommation', 'CV', 'AnneeMenCirc', 'DateEntree', 'KMActuel', 'detenteur_id', 'chauffeur_id'];

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    public function detenteur()
    {
        return $this->belongsTo(Detenteur::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

    public function contenir()
    {
        return $this->hasOne(Contenir::class);
    }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'contenirs')->withPivot('dernierKM');
    }

    public function visite()
    {
        return $this->hasOne(Visite::class);
    }

    public function assurance()
    {
        return $this->hasOne(Assurance::class);
    }

    public function dpannes()
    {
        return $this->hasMany(DPanne::class);
    }
}
