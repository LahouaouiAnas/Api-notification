<?php

namespace App\Models;

use App\Models\Event;
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

    protected $fillable = [
            'ref',
            'statue',
            'project_title',
            'researcher_id',
            'date_de_depot'
    ];
}
