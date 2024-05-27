@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Trip</h1>
        <form action="{{ route('trips.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="type">Trip Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="one-way">One-Way</option>
                    <option value="round-trip">Round-Trip</option>
                </select>
            </div>
            <div class="form-group">
                <label for="departure_airport_id">Departure Airport</label>
                <select id="departure_airport_id" name="departure_airport_id" class="form-control" required>
                    @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="arrival_airport_id">Arrival Airport</label>
                <select id="arrival_airport_id" name="arrival_airport_id" class="form-control" required>
                    @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="departure_date">Departure Date</label>
                <input type="datetime-local" id="departure_date" name="departure_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="return_date">Return Date (for round-trip)</label>
                <input type="datetime-local" id="return_date" name="return_date" class="form-control">
            </div>
            <h3>Flights</h3>
            <div id="flights">
                <div class="flight">
                    <div class="form-group">
                        <label for="flight_id_1">Flight</label>
                        <select id="flight_id_1" name="flights[0][id]" class="form-control" required>
                            @foreach ($flights as $flight)
                                <option value="{{ $flight->id }}">{{ $flight->flight_number }} ({{ $flight->departureAirport->iata_code }} to {{ $flight->arrivalAirport->iata_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flight_date_1">Flight Date</label>
                        <input type="datetime-local" id="flight_date_1" name="flights[0][date]" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="button" id="add-flight" class="btn btn-secondary mb-3">Add Flight</button>
            <button type="submit" class="btn btn-primary">Add Trip</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addFlightButton = document.getElementById('add-flight');
            const flightsContainer = document.getElementById('flights');
            let flightCount = 1;

            addFlightButton.addEventListener('click', function() {
                flightCount++;
                const flightDiv = document.createElement('div');
                flightDiv.classList.add('flight');
                flightDiv.innerHTML = `
                    <div class="form-group">
                        <label for="flight_id_${flightCount}">Flight</label>
                        <select id="flight_id_${flightCount}" name="flights[${flightCount - 1}][id]" class="form-control" required>
                            ${document.getElementById('flight_id_1').innerHTML}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flight_date_${flightCount}">Flight Date</label>
                        <input type="datetime-local" id="flight_date_${flightCount}" name="flights[${flightCount - 1}][date]" class="form-control" required>
                    </div>
                `;
                flightsContainer.appendChild(flightDiv);
            });
        });
    </script>
@endsection
