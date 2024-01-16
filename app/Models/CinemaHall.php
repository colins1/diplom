<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaHall extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'hall_number',
        'number_of_seats',
        'price_per_regular_seat',
        'price_per_vip_seat',
        'vip_seats',
        'unavailable_seats'
    ];
}
