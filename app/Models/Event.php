<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'date_start',
        'date_end',
        'location',
        'thumbnail',
        'event_status'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
