<?php

namespace App\Console\Commands;

use Domain\Common\Models\Address;
use Domain\Common\Models\Category;
use Domain\Stations\Models\ControlCenter;
use Domain\Stations\Models\District;
use Domain\Stations\Models\Station;
use Domain\Stations\Models\StationType;
use Domain\Users\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Support\Traits\HasGeometryCenter;

class ImportFireStationsFromOverpass extends Command
{
    use HasGeometryCenter;

    protected $signature = 'import:firestations {file}';

    protected $description = 'Import fire stations from a GeoJSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (! file_exists($filePath)) {
            $this->error('File not found.');

            return 1;
        }

        $geoJson = json_decode(file_get_contents($filePath), true);

        if (! isset($geoJson['features'])) {
            $this->error('Invalid GeoJSON format.');

            return 1;
        }

        $this->createAutoImportModels();

        foreach ($geoJson['features'] as $feature) {
            $properties = $feature['properties'];

            if (empty($properties['name'])) {
                continue;
            }

            $station = $this->createStation($feature);
            $this->createAddressForStation($station, $properties);
        }

        $this->info('Import completed.');
    }

    protected function createStation($feature)
    {
        $properties = $feature['properties'];
        $geometry = $feature['geometry'];
        $osmId = $feature['id'];

        $stationTypeId = StationType::query()->whereName($this->determineStationType($properties['name']))->first()?->id;

        $coordinates = $geometry['type'] === 'Point'
            ? [$geometry['coordinates'][1], $geometry['coordinates'][0]]
            : $this->determinePolygonCenter(collect($geometry['coordinates'][0]));

        $station = Station::updateOrCreate(['osm_id' => $osmId], [
            'name' => $properties['name'],
            'website' => $properties['website'] ?? null,
            'location' => new Point($coordinates[0], $coordinates[1], Srid::WGS84->value),
            'status' => 'system_import',
            'description' => json_encode(['text' => $properties['description'] ?? '']),
            'user_id' => '00000000-0000-0000-0000-000000000000',
            'station_type_id' => $stationTypeId,
            'district_id' => '00000000-0000-0000-0000-000000000000',
            'control_center_id' => '00000000-0000-0000-0000-000000000000',
            'osm_id' => $osmId,
        ]);

        if ($station->wasRecentlyCreated) {
            $this->info(sprintf('Imported Station %s %s [OSM %s]', $station->id, $station->name, $osmId));
        }

        return $station;
    }

    protected function createAutoImportModels()
    {
        User::updateOrCreate(['id' => '00000000-0000-0000-0000-000000000000'], [
            'id' => '00000000-0000-0000-0000-000000000000',
            'first_name' => 'System',
            'last_name' => 'User',
            'username' => config('system.user.username'),
            'email' => config('system.user.email'),
            'password' => bcrypt(config('system.user.password')),
        ]);

        District::updateOrCreate(['id' => '00000000-0000-0000-0000-000000000000'], [
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'AUTO_IMPORT_CONTROL_CENTER',
            'location' => new Point(48.137146, 11.575562, Srid::WGS84->value),
            'type' => \Domain\Stations\Enums\District::FEDERAL_STATE->value,
        ]);

        ControlCenter::updateOrCreate(['id' => '00000000-0000-0000-0000-000000000000'], [
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'AUTO_IMPORT_CONTROL_CENTER',
            'location' => new Point(48.137146, 11.575562, Srid::WGS84->value),
            'osm_id' => '00000000-0000-0000-0000-000000000000',
        ]);

        Category::updateOrCreate(['id' => '00000000-0000-0000-0000-000000000000'], [
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'AUTO_IMPORT_FIRE_STATION',
        ]);

        StationType::updateOrCreate(['id' => '00000000-0000-0000-0000-000000000000'], [
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'AUTO_IMPORT_STATION_TYPE',
            'description' => json_encode([]),
            'category_id' => '00000000-0000-0000-0000-000000000000',
        ]);
    }

    protected function determineStationType(string $name): string
    {
        $stationTypeLookup = [
            'Berufs' => 'Berufsfeuerwehr',
            'Betrieb' => 'Betriebsfeuerwehr',
            'FF' => 'Freiwillige Feuerwehr',
            'Freiwillig' => 'Freiwillige Feuerwehr',
            'Werk' => 'Werkfeuerwehr',
            'Wasser' => 'Wasserrettung',
            'Rettung' => 'Rettungswache',
        ];

        foreach ($stationTypeLookup as $key => $value) {
            if (Str::startsWith($name, $key)) {
                return $value;
            }
        }

        return 'AUTO_IMPORT_STATION_TYPE';
    }

    protected function createAddressForStation(Station $station, array $properties): void
    {
        if (isset($properties['addr:city']) || isset($properties['addr:street']) || isset($properties['addr:housenumber']) || isset($properties['addr:postcode'])) {
            $address = new Address([
                'city' => $properties['addr:city'] ?? '',
                'country' => $properties['addr:country'] ?? '',
                'county' => '',
                'street' => $properties['addr:street'] ?? '',
                'number' => $properties['addr:housenumber'] ?? '',
                'zip' => $properties['addr:postcode'] ?? '',
            ]);

            $station->address()->save($address);
        }
    }
}
