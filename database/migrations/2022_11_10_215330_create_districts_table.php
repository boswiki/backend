<?php

use Domain\Stations\Enums\AdministrativeDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->geometry('bounding_box')->nullable();
            $table->geometry('border')->nullable();
            $table->point('location', 4326);
            $table->enum('type', [
                AdministrativeDivision::STATE->value,
                AdministrativeDivision::GOVERNMENT_DISTRICT->value,
                AdministrativeDivision::DISTRICT->value,
                AdministrativeDivision::RURAL_DISTRICT->value,
                AdministrativeDivision::URBAN_DISTRICT->value,
                AdministrativeDivision::MUNICIPALITY->value,
                AdministrativeDivision::CITY_DISTRICT->value,
            ]);
            $table->timestamps();
        });
    }
};
