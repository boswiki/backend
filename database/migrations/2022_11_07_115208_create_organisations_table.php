<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('abbreviation')->nullable();
            $table->string('website')->nullable();

            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Address::class)->nullable()->constrained();

            $table->timestamps();
        });
    }
};
