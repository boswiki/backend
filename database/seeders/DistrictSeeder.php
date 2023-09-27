<?php

namespace Database\Seeders;

use Domain\Stations\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\MultiPolygon;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'Baden-Württemberg', 'type' => 'federal_state', 'location' => ['lat' => 48.775002, 'lng' => 9.177800]],
            ['name' => 'Bayern', 'type' => 'federal_state', 'location' => ['lat' => 48.137146, 'lng' => 11.575562]],
            ['name' => 'Berlin', 'type' => 'federal_state', 'location' => ['lat' => 52.5182775, 'lng' => 13.4060694]],
            ['name' => 'Brandenburg', 'type' => 'federal_state', 'location' => ['lat' => 52.4283329, 'lng' => 12.9450129]],
            ['name' => 'Bremen', 'type' => 'federal_state', 'location' => ['lat' => 53.0800302, 'lng' => 8.7815399]],
            ['name' => 'Hamburg', 'type' => 'federal_state', 'location' => ['lat' => 53.543048, 'lng' => 9.9807687]],
            ['name' => 'Hessen', 'type' => 'federal_state', 'location' => ['lat' => 50.0781633, 'lng' => 8.2394743]],
            ['name' => 'Mecklenburg-Vorpommern', 'type' => 'federal_state', 'location' => ['lat' => 53.6352268, 'lng' => 11.4001358]],
            ['name' => 'Niedersachsen', 'type' => 'federal_state', 'location' => ['lat' => 52.3759776, 'lng' => 9.7321339]],
            ['name' => 'Nordrhein-Westfalen', 'type' => 'federal_state', 'location' => ['lat' => 51.2280316, 'lng' => 6.7729216]],
            ['name' => 'Rheinland-Pfalz', 'type' => 'federal_state', 'location' => ['lat' => 50.0023393, 'lng' => 8.2695198]],
            ['name' => 'Saarland', 'type' => 'federal_state', 'location' => ['lat' => 49.2339616, 'lng' => 6.9933004]],
            ['name' => 'Sachsen', 'type' => 'federal_state', 'location' => ['lat' => 51.0480343, 'lng' => 13.7378036]],
            ['name' => 'Sachsen-Anhalt', 'type' => 'federal_state', 'location' => ['lat' => 52.1313934, 'lng' => 11.6375017]],
            ['name' => 'Schleswig-Holstein', 'type' => 'federal_state', 'location' => ['lat' => 54.3207394, 'lng' => 10.1314559]],
            ['name' => 'Thüringen', 'type' => 'federal_state', 'location' => ['lat' => 50.9779287, 'lng' => 11.0265723]],
        ])->each(function ($federalDistrict) {
            District::updateOrCreate(
                ['name' => $federalDistrict['name']],
                [
                    'name' => $federalDistrict['name'],
                    'type' => $federalDistrict['type'],
                    'location' => new Point(
                        latitude: $federalDistrict['location']['lat'],
                        longitude: $federalDistrict['location']['lng'],
                        srid: Srid::WGS84->value
                    ),
                ]
            );
        });

        $data = json_decode(File::get(database_path('fixtures/federal-borders.geojson')), true);

        $handlers = [
            'Polygon' => fn($coordinates) => $this->handlePolygon($coordinates),
            'MultiPolygon' => fn($coordinates) => $this->handleMultiPolygon($coordinates),
        ];

        collect($data['features'])->each(function ($feature) use ($handlers) {
            $district = District::query()->where('name', $feature['properties']['name'])->first();
            $this->command->info($feature['properties']['name']);
            $this->command->info($district->name);

            if (!$district) return;

            $geometry = $feature['geometry']['type'];
            if (isset($handlers[$geometry])) {
                $district->border = $handlers[$geometry]($feature['geometry']['coordinates']);
                $district->save();
            }
        });
    }

    private function handlePolygon($coordinates): Polygon
    {
        $points = collect($coordinates[0])
            ->map(fn($coord) => new Point($coord[1], $coord[0]))
            ->all();

        // Schließen Sie den Ring
        $points[] = $points[0];

        return new Polygon([
            new LineString($points, Srid::WGS84->value)
        ], Srid::WGS84->value);
    }

    private function handleMultiPolygon($coordinates)
    {
        // FIXME: currently the border can only store a polygon, that needs to be fixed
        return;
        $polygons = collect($coordinates)->map(function ($polygonCoordinates) {
            return $this->handlePolygon($polygonCoordinates);
        })->all();

        return new MultiPolygon($polygons, Srid::WGS84->value);
    }
}
