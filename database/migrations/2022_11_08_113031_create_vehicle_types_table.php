<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('parent_id')->constrained('vehicle_types');
            $table->foreignIdFor(\App\Domain\Common\Models\Category::class)->constrained();

            $table->timestamps();
        });
    }
};
