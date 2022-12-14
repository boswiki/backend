<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('description');
            $table->year('construction_year');
            $table->date('commissioning_date');
            $table->date('decommissioning_date');
            $table->tinyInteger('crew_count');

            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Organisation::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleManufacturer::class)->constrained();

            $table->foreignId('vehicle_type_id')->constrained('vehicle_types');
            $table->foreignId('vehicle_subtype_id')->nullable()->constrained('vehicle_types');

            $table->foreignIdFor(\App\Models\VehicleFitter::class)->nullable()->constrained();

            $table->timestamps();
        });
    }
};
