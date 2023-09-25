<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('website');
            $table->string('status');
            $table->json('description');
            $table->point('location', 4326);
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('station_type_id')->constrained();
            $table->foreignUuid('district_id')->constrained();
            $table->foreignUuid('control_center_id')->constrained();
        });
    }
};
