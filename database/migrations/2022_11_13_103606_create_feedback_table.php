<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->enum('type', [
                \App\Enums\Feedback::BUG->value,
                \App\Enums\Feedback::IDEA->value,
                \App\Enums\Feedback::PRAISE->value,
                \App\Enums\Feedback::OTHER->value,
            ]);
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->timestamps();
        });
    }
};
