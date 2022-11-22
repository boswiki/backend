<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('control_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->point('location', 4326);
            $table->foreignIdFor(\App\Domain\Common\Models\Address::class)->constrained();
            $table->timestamps();
        });
    }
};
