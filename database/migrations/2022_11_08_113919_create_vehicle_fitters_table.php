<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicle_fitters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('website');

            $table->foreignIdFor(\App\Domain\Users\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Domain\Common\Models\Address::class)->constrained();

            $table->timestamps();
        });
    }
};
