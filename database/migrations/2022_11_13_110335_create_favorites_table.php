<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('favorable');
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
