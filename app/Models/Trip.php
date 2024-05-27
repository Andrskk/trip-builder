<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'departure_airport_id', 'arrival_airport_id', 'departure_date', 'return_date', 'price'
    ];

    protected $hidden = ['id','created_at','updated_at','departure_airport_id', 'arrival_airport_id', 'pivot'];

    public function flights()
    {
        return $this->belongsToMany(Flight::class, 'trip_flight')->withPivot('flight_date');
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }
}
