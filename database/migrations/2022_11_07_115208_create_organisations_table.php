<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->string('abbreviation')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('category_id')->constrained();
        });
    }
};
