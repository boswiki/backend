<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('street');
            $table->string('number', 10);
            $table->string('zip', 10);
            $table->string('county');
            $table->string('city');
            $table->string('country');
            $table->uuidMorphs('addressable');
            $table->timestamps();
        });
    }
};
