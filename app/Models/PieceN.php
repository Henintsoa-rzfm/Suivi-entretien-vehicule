<?php

namespace App\Models;

use App\Models\Equipement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PieceN extends Model
{
    use HasFactory;

    protected $fillable = ['NomPiece', 'equipement_id'];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
