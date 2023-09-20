<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('station_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('description');
            $table->foreignIdFor(\Domain\Common\Models\Category::class)->constrained();
            $table->timestamps();
        });
    }
};
