<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->polygon('bounding_box');
            $table->polygon('border');
            $table->point('location', 4326);
            $table->timestamps();
        });
    }
};
