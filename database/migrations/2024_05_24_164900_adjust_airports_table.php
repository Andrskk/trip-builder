<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AdjustAirportsTable extends Migration
{
    public function up()
    {
        Schema::table('airports', function (Blueprint $table) {
            // Rename existing columns
            DB::statement('ALTER TABLE airports CHANGE iataAirportCode iata_code VARCHAR(255)');
            DB::statement('ALTER TABLE airports CHANGE latit latitude DECIMAL(10, 7)');
            DB::statement('ALTER TABLE airports CHANGE longit longitude DECIMAL(10, 7)');
            
            // Add new city_code column
            $table->string('city_code')->after('city');
        });
    }

    public function down()
    {
        Schema::table('airports', function (Blueprint $table) {
            // Revert column names
            DB::statement('ALTER TABLE airports CHANGE iata_code iataAirportCode VARCHAR(255)');
            DB::statement('ALTER TABLE airports CHANGE latitude latit VARCHAR(255)');
            DB::statement('ALTER TABLE airports CHANGE longitude longit VARCHAR(255)');
            
            // Drop the city_code column
            $table->dropColumn('city_code');
        });
    }
}
