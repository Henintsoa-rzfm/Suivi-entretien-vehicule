<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
            'PlaqueImmatric',
            'Vehicule', 'Energie',
            'Consommation',
            'CV',
            'AnneeMenCirc',
            'DateEntree',
            'KMActuel',
            'detenteur_id',
            'chauffeur_id'
        ];

    public function scopeEssence(Builder $query) : Builder
    {
        return $query->where('Energie', 'Essence');
    }

    public function scopeDiesel(Builder $query) : Builder
    {
        return $query->where('Energie', 'Diesel');
    }

    public function interventions() : HasMany
    {
        return $this->hasMany(Intervention::class);
    }

    public function contenir() : HasOne
    {
        return $this->hasOne(Contenir::class);
    }

    public function equipements() : BelongsToMany
    {
        return $this->belongsToMany(Equipement::class, 'contenirs')->withPivot('dernierKM');
    }

    public function visite() : HasOne
    {
        return $this->hasOne(Visite::class);
    }

    public function assurance() : HasOne
    {
        return $this->hasOne(Assurance::class);
    }

    public function dpannes() : HasMany
    {
        return $this->hasMany(DPanne::class);
    }
}
