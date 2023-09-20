<?php

use Domain\Feedback\Enums\Feedback;
use Domain\Users\Models\User;
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
                Feedback::BUG->value,
                Feedback::IDEA->value,
                Feedback::PRAISE->value,
                Feedback::OTHER->value,
            ]);
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });
    }
};
