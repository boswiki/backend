<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('control_centers', function (Blueprint $table) {
            $table->string('website')->nullable();
            $table->string('osm_id')->nullable();
        });
    }
};