<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detenteur extends Model
{
    use HasFactory;

    protected $fillable = ['MatrDetenteur', 'Detenteur', 'Poste'];

    public function vehicule()
    {
        return $this->hasOne(Vehicule::class);
    }
}
