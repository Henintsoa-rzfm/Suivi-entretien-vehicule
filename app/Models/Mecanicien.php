<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mecanicien extends Model
{
    use HasFactory;

    protected $fillable = ['MatrMeca', 'Mecanicien'];

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
