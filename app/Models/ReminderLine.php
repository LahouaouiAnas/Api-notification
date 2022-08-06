<?php

namespace App\Models;

use App\Models\File;
use App\Models\Dossier;
use App\Models\ReminderLine;
use App\Models\ReminderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReminderLine extends Model
{
    use HasFactory;

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }

    public function remindertype()
    {
        return $this->belongsTo(ReminderType::class, 'reminder_type_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    protected $fillable = [
        'dossier_id',
        'premiere_notif_date',
        'deuxieme_notif_date',
        'notif_date',
        'reminder_type_id',
        'reminder_type_id',
        'actif',
        'done'
    ];
    
}
