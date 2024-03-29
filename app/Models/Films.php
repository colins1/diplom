<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country',
        'minutes',
        'is_published',
        'hall'
    ];
}
