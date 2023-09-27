<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->timestamps();

            $table->uuidMorphs('reportable');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
