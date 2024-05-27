<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::all();
        return response()->json($airports);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'iata_code' => 'required|string|max:3|unique:airports,iata_code',
            'city' => 'required|string|max:255',
            'city_code' => 'required|string|max:3',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'timezone' => 'required|string|max:255',
        ]);

        $airport = Airport::create($request->all());
        return response()->json($airport, 201);
    }

    public function show($id)
    {
        $airport = Airport::findOrFail($id);
        return response()->json($airport);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'iata_code' => 'sometimes|required|string|max:3|unique:airports,iata_code,'.$id,
            'city' => 'sometimes|required|string|max:255',
            'city_code' => 'sometimes|required|string|max:3',
            'latitude' => 'sometimes|required|numeric|between:-90,90',
            'longitude' => 'sometimes|required|numeric|between:-180,180',
            'timezone' => 'sometimes|required|string|max:255',
        ]);

        $airport = Airport::findOrFail($id);
        $airport->update($request->all());
        return response()->json($airport);
    }

    public function destroy($id)
    {
        $airport = Airport::findOrFail($id);
        $airport->delete();
        return response()->json(null, 204);
    }
}
