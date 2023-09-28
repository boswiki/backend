<?php

namespace Database\Seeders;

use Domain\Stations\Enums\AdministrativeDivision;
use Domain\Stations\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\MultiPolygon;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class DistrictSeeder extends Seeder
{
    protected array $geometryHandler = [];

    public function __construct()
    {
        $this->geometryHandler = [
            'Polygon' => fn ($coordinates) => $this->handlePolygon($coordinates),
            'MultiPolygon' => fn ($coordinates) => $this->handleMultiPolygon($coordinates),
        ];
    }

    public function run(): void
    {
        collect([
            ['name' => 'Baden-Württemberg', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 48.775002, 'lng' => 9.177800]],
            ['name' => 'Bayern', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 48.137146, 'lng' => 11.575562]],
            ['name' => 'Berlin', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 52.5182775, 'lng' => 13.4060694]],
            ['name' => 'Brandenburg', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 52.4283329, 'lng' => 12.9450129]],
            ['name' => 'Bremen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 53.0800302, 'lng' => 8.7815399]],
            ['name' => 'Hamburg', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 53.543048, 'lng' => 9.9807687]],
            ['name' => 'Hessen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 50.0781633, 'lng' => 8.2394743]],
            ['name' => 'Mecklenburg-Vorpommern', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 53.6352268, 'lng' => 11.4001358]],
            ['name' => 'Niedersachsen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 52.3759776, 'lng' => 9.7321339]],
            ['name' => 'Nordrhein-Westfalen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 51.2280316, 'lng' => 6.7729216]],
            ['name' => 'Rheinland-Pfalz', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 50.0023393, 'lng' => 8.2695198]],
            ['name' => 'Saarland', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 49.2339616, 'lng' => 6.9933004]],
            ['name' => 'Sachsen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 51.0480343, 'lng' => 13.7378036]],
            ['name' => 'Sachsen-Anhalt', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 52.1313934, 'lng' => 11.6375017]],
            ['name' => 'Schleswig-Holstein', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 54.3207394, 'lng' => 10.1314559]],
            ['name' => 'Thüringen', 'type' => AdministrativeDivision::STATE->value, 'location' => ['lat' => 50.9779287, 'lng' => 11.0265723]],
        ])->each(function ($federalDistrict) {
            $district = District::updateOrCreate(
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
            $this->command->info("Created state district {$district->name}");

            $this->importFederalStateBorders($district);
            $this->importFederalStateDistricts($district);
        });

    }

    protected function importFederalStateBorders(District $district): void
    {
        $data = json_decode(File::get(database_path('fixtures/federal-borders.geojson')), true);

        $boundary = collect($data['features'])->filter(fn ($feature) => $feature['properties']['name'] === $district->name
        )->first();

        $geometryType = $boundary['geometry']['type'];

        if (isset($this->geometryHandler[$geometryType])) {
            $district->border = $this->geometryHandler[$geometryType]($boundary['geometry']['coordinates']);
            $district->save();

            $this->command->info("Imported border for {$district->name}");
        }
    }

    protected function importFederalStateDistricts(District $stateDistrict): void
    {
        if (File::exists($filePath = database_path('fixtures/districts').'/'.$stateDistrict->name.'.geojson')) {
            $data = json_decode(File::get($filePath), true);

            $districtCenters = collect($data['features'])->filter(fn ($boundary) => $boundary['geometry']['type'] === 'Point'
            );

            $districtBoundaries = collect($data['features'])->filter(fn ($boundary) => $boundary['geometry']['type'] === 'Polygon' || $boundary['geometry']['type'] === 'MultiPolygon'
            );

            $districtBoundaries->each(function ($feature) use ($stateDistrict, $districtCenters) {
                $geometry = $feature['geometry']['type'];
                $properties = $feature['properties'];

                $districtCenter = $districtCenters->first(fn ($center) => $center['properties']['@relations'][0]['rel'] == explode('/', $feature['id'])[1]
                );

                if (empty($districtCenter)) {
                    return;
                }

                if (isset($this->geometryHandler[$geometry])) {
                    $ruralDistrict = District::create([
                        'id' => Str::uuid()->toString(),
                        'name' => $properties['name'],
                        'location' => new Point(
                            $districtCenter['geometry']['coordinates'][1],
                            $districtCenter['geometry']['coordinates'][0],
                            Srid::WGS84->value
                        ),
                        'type' => AdministrativeDivision::RURAL_DISTRICT->value,
                        'border' => $this->geometryHandler[$geometry]($feature['geometry']['coordinates']),
                        'osm_id' => $feature['id'],
                        'parent_id' => $stateDistrict->id,
                    ]);
                    $this->command->info("Created new rural district {$ruralDistrict->name}");
                }
            });

            // ... rest of your processing
        } else {
            // Handle the case where the file does not exist.
            $this->command->error("File for {$stateDistrict->name} not found.");
        }
    }

    protected function handlePolygon($coordinates): Polygon
    {
        $points = collect($coordinates[0])
            ->map(fn ($coord) => new Point($coord[1], $coord[0]))
            ->all();

        // Schließen Sie den Ring
        $points[] = $points[0];

        return new Polygon([
            new LineString($points, Srid::WGS84->value),
        ], Srid::WGS84->value);
    }

    protected function handleMultiPolygon($coordinates): MultiPolygon
    {
        // FIXME: currently the border can only store a polygon, that needs to be fixed
        $polygons = collect($coordinates)->map(function ($polygonCoordinates) {
            return $this->handlePolygon($polygonCoordinates);
        })->all();

        return new MultiPolygon($polygons, Srid::WGS84->value);
    }
}
