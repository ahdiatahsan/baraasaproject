<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
