<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('district_user', function (Blueprint $table) {
            $table->primary(['district_id', 'user_id']);
            $table->foreignIdFor(\App\Domain\Stations\Models\District::class)->constrained();
            $table->foreignIdFor(\App\Domain\Users\Models\User::class)->constrained();
            $table->timestamps();
        });
    }
};
