<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('district_user', function (Blueprint $table) {
            $table->primary(['district_id', 'user_id']);
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('district_id')->constrained()->cascadeOnDelete();
        });
    }
};
