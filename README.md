# Trip Builder API

## Overview

Trip Builder API is a back-end application built with the Laravel framework. It provides endpoints for managing airlines, airports, flights, and trips, allowing clients to search and book trips efficiently.

## Features

-   Manage airlines, airports, and flights.
-   Create and manage trips (one-way, round-trip).
-   JSON responses for all endpoints.

## Requirements

-   PHP 7.4 or higher
-   Composer
-   MySQL
-   Laravel 8.x

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/Andrskk/trip-builder.git
    cd trip-builder
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Set up environment variables:**
   Copy the `.env.example` file to `.env` and update the necessary environment variables.

    ```bash
    cp .env.example .env
    nano .env
    ```

4. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

5. **Run migrations:**

    ```bash
    php artisan migrate
    ```

6. **Seed the database (if applicable):**

    ```bash
    php artisan db:seed
    ```

7. **Serve the application:**
    ```bash
    php artisan serve
    ```

## API Endpoints

### Airlines

-   **List all airlines**

    ```http
    GET /api/airlines
    ```

-   **Create a new airline**
    ```http
    POST /api/airlines
    ```
    **Request Body:**
    ```json
    {
        "name": "Air Canada",
        "iata_code": "AC"
    }
    ```

### Airports

-   **List all airports**

    ```http
    GET /api/airports
    ```

-   **Create a new airport**
    ```http
    POST /api/airports
    ```
    **Request Body:**
    ```json
    {
        "name": "Pierre Elliott Trudeau International",
        "iata_code": "YUL",
        "city": "Montreal",
        "latitude": 45.4706,
        "longitude": -73.7408,
        "timezone": "America/Toronto",
        "city_code": "YMQ"
    }
    ```

### Flights

-   **List all flights**

    ```http
    GET /api/flights
    ```

-   **Create a new flight**
    ```http
    POST /api/flights
    ```
    **Request Body:**
    ```json
    {
        "airline_id": 1,
        "flight_number": "AC301",
        "departure_airport_id": 1,
        "arrival_airport_id": 2,
        "departure_time": "07:35",
        "arrival_time": "10:05",
        "price": 200.0
    }
    ```

## Testing

To test the API endpoints, you can use tools like Postman or cURL.

### Using Postman

1. **Create a new request**.
2. **Set the request type** to `POST`.
3. **Enter the endpoint URL**.
4. **Set the headers**:
    - Content-Type: application/json
5. **Set the request body** with the required JSON data.
6. **Send the request** and inspect the response.

### Using cURL

```bash
curl -X POST https://api.yourdomain.com/api/flights \
-H "Content-Type: application/json" \
-d '{
    "flight_number": "AA505",
    "airline_id": 3,
    "departure_airport_id": 3,
    "arrival_airport_id": 4,
    "departure_time": "09:00",
    "arrival_time": "12:00",
    "price": 250.00
}'
```

## Deployment

1. **Choose a hosting provider** (e.g., DigitalOcean, AWS, shared hosting).
2. **Set up a server** and install necessary software (PHP, MySQL, Composer).
3. **Clone the repository** to the server.
4. **Set up environment variables** on the server.
5. **Run migrations** and seed the database.
6. **Set permissions** for storage and cache directories.
7. **Configure the web server** (Apache or Nginx).
8. **Restart the web server** to apply changes.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
