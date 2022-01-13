<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'first_stage',
        'second_stage',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
