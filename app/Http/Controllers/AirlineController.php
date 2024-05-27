<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class AirlineController extends Controller
{
    public function store(Request $request)
    {
        $airline = Airline::create($request->all());
        return response()->json($airline, 201);
    }

    public function index()
    {
        $airlines = Airline::all();
        return response()->json($airlines);
    }

    public function show($id)
    {
        $airline = Airline::findOrFail($id);
        return response()->json($airline);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'iata_code' => 'sometimes|required|string|max:3|unique:airlines,iata_code,'.$id,
        ]);

        $airline = Airline::findOrFail($id);
        $airline->update($request->all());
        return response()->json($airline);
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();

        return response()->json([
            'message' => 'airline is deleted successfully'
        ]);
    }
}
