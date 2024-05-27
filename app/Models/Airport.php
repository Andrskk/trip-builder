<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name', 'iata_code', 'city', 'city_code', 'latitude', 'longitude', 'timezone'
    ];

    protected $hidden = ['id','created_at','updated_at', 'pivot'];
}
