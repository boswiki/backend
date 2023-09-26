<?php

namespace Database\Seeders;

use Domain\Common\Models\Category;
use Domain\Stations\Models\StationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryAndStationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding Categories and StationTypes...');

        collect([
            'Feuerwehr' => [
                'Berufsfeuerwehr',
                'Freiwillige Feuerwehr',
                'Werkfeuerwehr',
                'Betriebsfeuerwehr',
                'Pflichtfeuerwehr'
            ],
            'Rettungsdienst' => [
                'Rettungswache',
                'Notarztstandort',
                'Wasserwacht',
                'Bergwacht'
            ],
            'Polizei' => [
                'Polizeiwache',
                'Polizeiinspektion',
                'Kriminalpolizeiinspektion',
                'Autobahnpolizeiwache',
                'Bereitschaftspolizei'
            ],
            'Technisches Hilfswerk (THW)' => [
                'THW-Ortsverband'
            ],
            'Sonstige' => [
                'Katastrophenschutz'
            ]
        ])->each(function ($stationTypes, $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            if ($category->wasRecentlyCreated) {
                $this->command->info($category->id . ' ' . $categoryName);
            }

            collect($stationTypes)->each(function ($stationTypeName) use ($category) {
                $stationType = StationType::firstOrCreate([
                    'name' => $stationTypeName,
                    'category_id' => $category->id,
                    'description' => json_encode([])
                ]);

                if ($stationType->wasRecentlyCreated) {
                    $this->command->info($stationType->id . ' ' . $stationTypeName);
                }
            });
        });

        $this->command->info('Finished seeding Categories');
    }
}
