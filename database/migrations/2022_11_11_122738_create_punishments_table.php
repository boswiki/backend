<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('punishments', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->date('expires_in');
            $table->foreignIdFor(\Domain\Users\Models\User::class)->constrained();
            $table->timestamps();
        });
    }
};
