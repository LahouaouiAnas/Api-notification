<?php

namespace App\Models;

use App\Models\Researcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    public function researchers()
    {
        return $this->hasMany(Researcher::class);
    }

    protected $fillable = [
        'nom'
];
}

