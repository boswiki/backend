<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->json('description');
            $table->year('construction_year');
            $table->date('commissioning_date');
            $table->date('decommissioning_date');
            $table->tinyInteger('crew_count');
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('category_id')->constrained();
            $table->foreignUuid('organisation_id')->constrained();
            $table->foreignUuid('vehicle_manufacturer_id')->constrained();
            $table->foreignUuid('vehicle_fitter_id')->nullable()->constrained();
            $table->foreignUuid('vehicle_type_id')->constrained();
        });
    }
};
