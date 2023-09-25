<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('control_centers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->point('location', 4326);
            $table->timestamps();
        });
    }
};
