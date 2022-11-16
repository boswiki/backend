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

            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\Station::class)->constrained();

            $table->timestamps();
        });
    }
};
