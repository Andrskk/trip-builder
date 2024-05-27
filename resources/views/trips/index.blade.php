@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trips</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('trips.create') }}" class="btn btn-primary mb-3">Add Trip</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trips as $trip)
                    <tr>
                        <td>{{ ucfirst($trip->type) }}</td>
                        <td>{{ $trip->departureAirport->name }} ({{ $trip->departureAirport->iata_code }})</td>
                        <td>{{ $trip->arrivalAirport->name }} ({{ $trip->arrivalAirport->iata_code }})</td>
                        <td>{{ $trip->departure_date }}</td>
                        <td>{{ $trip->return_date }}</td>
                        <td>${{ $trip->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
