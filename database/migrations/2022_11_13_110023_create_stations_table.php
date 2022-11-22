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

            $table->foreignIdFor(\App\Domain\Common\Models\Address::class)->constrained();
            $table->foreignIdFor(\App\Domain\Users\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Domain\Stations\Models\StationType::class)->constrained();
            $table->foreignIdFor(\App\Domain\Stations\Models\District::class)->constrained();

            $table->timestamps();
        });
    }
};
