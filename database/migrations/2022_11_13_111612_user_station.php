<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_station', function (Blueprint $table) {
            $table->primary(['user_id', 'station_id']);
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('station_id')->constrained();
        });
    }
};
