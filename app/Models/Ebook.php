<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail',
        'file',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
