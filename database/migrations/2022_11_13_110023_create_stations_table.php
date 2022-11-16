<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('website');
            $table->json('description');
            $table->point('location', 4326);

            $table->foreignIdFor(\App\Models\Address::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\StationType::class)->constrained();
            $table->foreignIdFor(\App\Models\District::class)->constrained();

            $table->timestamps();
        });
    }
};
