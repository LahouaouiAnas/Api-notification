<?php

namespace App\Models;

use App\Models\ReminderLine;
use App\Models\ReminderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReminderLine extends Model
{
    use HasFactory;

    public function dossier()
    {
        return $this->belongsTo(dossier::class);
    }

    public function remindertype()
    {
        return $this->belongsTo(ReminderType::class);
    }

    protected $fillable = [
        'dossier_id',
        'notif_date',
        'reminder_type_id'
    ];
    
}
