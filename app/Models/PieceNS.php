<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceNS extends Model
{
    use HasFactory;

    protected $fillable = ['NomPiece', 'equipement_id'];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}

}
