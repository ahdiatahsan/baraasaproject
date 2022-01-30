<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'document_status',
        'interview_status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
