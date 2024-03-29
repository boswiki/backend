<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('value');
            $table->timestamps();

            $table->uuidMorphs('pointable');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
