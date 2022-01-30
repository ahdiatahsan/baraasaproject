<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'address',
        'instagram',
        'spotify',
        'recruitment_status',
        'recruitment_thumbnail'
    ];
}
