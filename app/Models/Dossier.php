<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Statue;
use App\Models\Statut;
use App\Models\Researcher;
use App\Models\ReminderLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;


    public function reminderLines()
    {
        return $this->hasMany(ReminderLine::class);
    }

    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }

    public function statue()
    {
        return $this->belongsTo(Statue::class);
    }


    protected $fillable = [
            'ref',
            'project_title',
            'researcher_id',
            'statue_id',
            'date_de_depot'
    ];
}

