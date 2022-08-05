<?php

namespace App\Models;

use App\Models\ReminderLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    public function reminderline()
    {
        return $this->belongsTo(ReminderLine::class);
    }

    protected $fillable = [
        'reminder_line_id',
        'name',
        'path'
    ];
}
