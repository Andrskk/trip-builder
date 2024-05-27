<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TripController;

Route::apiResource('/airlines', AirlineController::class);
Route::apiResource('/airports', AirportController::class);
Route::apiResource('/flights', FlightController::class);
//Route::apiResource('/trips', TripController::class);

// Routes for Trips
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
Route::post('/trips', [TripController::class, 'store'])->name('trips.store');