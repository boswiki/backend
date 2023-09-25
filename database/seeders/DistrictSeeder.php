<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ["name" => "Baden-Württemberg", "type" => "federal_state", "location" => ["lat" => 48.775002, "lng" => 9.177800]],
            ["name" => "Bayern", "type" => "federal_state", "location" => ["lat" => 48.137146, "lng" => 11.575562]],
            ["name" => "Berlin", "type" => "federal_state", "location" => ["lat" => 52.5182775, "lng" => 13.4060694]],
            ["name" => "Brandenburg", "type" => "federal_state", "location" => ["lat" => 52.4283329, "lng" => 12.9450129]],
            ["name" => "Bremen", "type" => "federal_state", "location" => ["lat" => 53.0800302, "lng" => 8.7815399]],
            ["name" => "Hamburg", "type" => "federal_state", "location" => ["lat" => 53.543048, "lng" => 9.9807687]],
            ["name" => "Hessen", "type" => "federal_state", "location" => ["lat" => 50.0781633, "lng" => 8.2394743]],
            ["name" => "Mecklenburg-Vorpommern", "type" => "federal_state", "location" => ["lat" => 53.6352268, "lng" => 11.4001358]],
            ["name" => "Niedersachsen", "type" => "federal_state", "location" => ["lat" => 52.3759776, "lng" => 9.7321339]],
            ["name" => "Nordrhein-Westfalen", "type" => "federal_state", "location" => ["lat" => 51.2280316, "lng" => 6.7729216]],
            ["name" => "Rheinland-Pfalz", "type" => "federal_state", "location" => ["lat" => 50.0023393, "lng" => 8.2695198]],
            ["name" => "Saarland", "type" => "federal_state", "location" => ["lat" => 49.2339616, "lng" => 6.9933004]],
            ["name" => "Sachsen", "type" => "federal_state", "location" => ["lat" => 51.0480343, "lng" => 13.7378036]],
            ["name" => "Sachsen-Anhalt", "type" => "federal_state", "location" => ["lat" => 52.1313934, "lng" => 11.6375017]],
            ["name" => "Schleswig-Holstein", "type" => "federal_state", "location" => ["lat" => 54.3207394, "lng" => 10.1314559]],
            ["name" => "Thüringen", "type" => "federal_state", "location" => ["lat" => 50.9779287, "lng" => 11.0265723]]
        ])->each(function ($federalDistrict) {
            DB::table('districts')->updateOrInsert(
                ['name' => $federalDistrict['name']],
                [
                    'id' => Str::uuid()->toString(),
                    'name' => $federalDistrict['name'],
                    'type' => $federalDistrict['type'],
                    'location' => DB::raw(
                        'ST_SRID(Point('.$federalDistrict['location']['lat'].', '.$federalDistrict['location']['lng'].'), 4326)'
                    )
                ]
            );
        });
    }
}
