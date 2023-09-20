<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        collect([
            'addresses',
            'categories',
            'control_centers',
            'districts',
            'feedback',
            'organisations',
            'points',
            'punishments',
            'reports',
            'roles',
            'station_types',
            'vehicle_fitters',
            'vehicle_manufacturers',
            'vehicle_types',
            'vehicles',
        ])->each(function ($table) {
            Schema::table($table, function (Blueprint $table) {
                $table->uuid('uuid')->after('id');
            });
        });
    }
};
