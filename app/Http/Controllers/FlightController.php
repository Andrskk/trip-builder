<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])->get();
        return response()->json($flights);
    }

    public function store(Request $request)
    {
        $request->validate([
            'flight_number' => 'required|string|max:10',
            'airline_id' => 'required|exists:airlines,id',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $flight = Flight::create($request->all());
        return response()->json($flight, 201);
    }

    public function show($id)
    {
        $flight = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])->findOrFail($id);
        return response()->json($flight);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'flight_number' => 'sometimes|required|string|max:10',
            'airline_id' => 'sometimes|required|exists:airlines,id',
            'departure_airport_id' => 'sometimes|required|exists:airports,id',
            'arrival_airport_id' => 'sometimes|required|exists:airports,id',
            'departure_time' => 'sometimes|required|date_format:H:i',
            'arrival_time' => 'sometimes|required|date_format:H:i',
            'price' => 'sometimes|required|numeric',
        ]);

        $flight = Flight::findOrFail($id);
        $flight->update($request->all());
        return response()->json($flight);
    }

    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
        return response()->json(null, 204);
    }
}
