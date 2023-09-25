<?php

use Domain\Stations\Enums\District;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->polygon('bounding_box')->nullable();
            $table->polygon('border')->nullable();
            $table->point('location', 4326);
            $table->enum('type', [
                District::FEDERAL_STATE->value,
                District::STATE_DISTRICT->value,
                District::CITY_DISTRICT->value,
            ]);
            $table->timestamps();
        });
    }
};
