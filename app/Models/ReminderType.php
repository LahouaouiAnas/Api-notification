<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderType extends Model
{
    use HasFactory;

    public function reminderLines()
    {
        return $this->hasMany(ReminderLine::class);
    }
}
