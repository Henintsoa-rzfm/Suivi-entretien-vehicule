<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPanne extends Model
{
    use HasFactory;

    protected $fillable = ['vehicule_id', 'panne_id', 'DatePanne'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function panne()
    {
        return $this->belongsTo(Panne::class);
    }
}
