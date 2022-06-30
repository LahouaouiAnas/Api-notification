<?php

namespace App\Models;

use App\Models\Dossier;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Researcher extends Model
{
    use HasFactory;

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'phone_number',
        'departement_id'
];
}
