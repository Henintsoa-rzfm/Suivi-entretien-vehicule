<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombre extends Model
{
    use HasFactory;

    protected $fillable = ['intervention_id', 'piece_id', 'Nombre'];

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }
}
