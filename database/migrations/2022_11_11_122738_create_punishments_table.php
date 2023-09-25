<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('punishments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reason');
            $table->date('expires_in');
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
