<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripController extends Controller
{
    /*
    public function index()
    {
        $trips = Trip::with(['flights'])->get();
        return response()->json($trips);
    }
    */
    public function index()
    {
        $trips = Trip::with(['flights'])->get();
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $airports = Airport::all();
        $flights = Flight::all();
        return view('trips.create', compact('airports', 'flights'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:one-way,round-trip',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_date' => 'required|date|after:now|before:' . Carbon::now()->addYear(),
            'return_date' => 'nullable|date|after:departure_date|before:' . Carbon::now()->addYear(),
            'flights' => 'required|array',
            'flights.*.id' => 'required|exists:flights,id',
            'flights.*.date' => 'required|date'
        ]);

        $trip = new Trip();
        $trip->type = $request->type;
        $trip->departure_airport_id = $request->departure_airport_id;
        $trip->arrival_airport_id = $request->arrival_airport_id;
        $trip->departure_date = Carbon::parse($request->departure_date);
        $trip->return_date = $request->type == 'round-trip' ? Carbon::parse($request->return_date) : null;

        $price = 0;
        foreach ($request->flights as $flightData) {
            $flight = Flight::find($flightData['id']);
            $price += $flight->price;
        }
        $trip->price = $price;
        $trip->save();

        foreach ($request->flights as $flightData) {
            $trip->flights()->attach($flightData['id'], ['flight_date' => Carbon::parse($flightData['date'])]);
        }

        //return response()->json($trip, 201);
        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');

    }

    public function show($id)
    {
        $trip = Trip::with(['flights'])->findOrFail($id);
        return response()->json($trip);
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $request->validate([
            'type' => 'sometimes|required|string|in:one-way,round-trip',
            'departure_airport_id' => 'sometimes|required|exists:airports,id',
            'arrival_airport_id' => 'sometimes|required|exists:airports,id',
            'departure_date' => 'sometimes|required|date|after:now|before:' . Carbon::now()->addYear(),
            'return_date' => 'nullable|date|after:departure_date|before:' . Carbon::now()->addYear(),
            'flights' => 'sometimes|array',
            'flights.*.id' => 'required_with:flights|exists:flights,id',
            'flights.*.date' => 'required_with:flights|date'
        ]);

        if ($request->has('type')) $trip->type = $request->type;
        if ($request->has('departure_airport_id')) $trip->departure_airport_id = $request->departure_airport_id;
        if ($request->has('arrival_airport_id')) $trip->arrival_airport_id = $request->arrival_airport_id;
        if ($request->has('departure_date')) $trip->departure_date = Carbon::parse($request->departure_date);
        if ($request->has('return_date')) $trip->return_date = Carbon::parse($request->return_date);

        if ($request->has('flights')) {
            $trip->flights()->detach();
            $price = 0;
            foreach ($request->flights as $flightData) {
                $flight = Flight::find($flightData['id']);
                $price += $flight->price;
                $trip->flights()->attach($flightData['id'], ['flight_date' => Carbon::parse($flightData['date'])]);
            }
            $trip->price = $price;
        }

        $trip->save();
        return response()->json($trip);
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return response()->json(null, 204);
    }
}