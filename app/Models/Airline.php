<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = 
    [
        'iataAirlineCode',
        'name',
    ];

    protected $hidden = ['id','created_at','updated_at', 'pivot'];
    
}
