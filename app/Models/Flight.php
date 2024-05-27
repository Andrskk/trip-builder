<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'flight_number', 'airline_id', 'departure_airport_id',
        'arrival_airport_id', 'departure_time', 'arrival_time', 'price'
    ];

    protected $hidden = ['id','created_at','updated_at','airline_id','departure_airport_id','arrival_airport_id', 'pivot'];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_flight')->withPivot('flight_date');
    }
}
