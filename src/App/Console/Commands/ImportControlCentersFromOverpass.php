<?php

namespace App\Console\Commands;

use Domain\Common\Models\Address;
use Domain\Stations\Models\ControlCenter;
use Domain\Stations\Models\District;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Support\Traits\HasGeometryCenter;

class ImportControlCentersFromOverpass extends Command
{
    use HasGeometryCenter;

    protected $signature = 'import:control-centers';

    protected $description = 'Import control centers from a GeoJSON file';

    public function handle()
    {
        $directoryPath = base_path('database/fixtures/control-centers');
        $filePaths = glob($directoryPath.'/*.geojson');

        if (empty($filePaths)) {
            $this->error('No matching files found.');

            return 1;
        }

        foreach ($filePaths as $filePath) {
            $geoJson = json_decode(File::get($filePath), true);
            $fileName = File::basename($filePath);

            [$federalStateName, $extension] = explode('.', $fileName);
            $this->info($federalStateName);

            if (! isset($geoJson['features'])) {
                $this->error('Invalid GeoJSON format.');

                return 1;
            }

            foreach ($geoJson['features'] as $feature) {
                $properties = $feature['properties'];

                if (empty($properties['name'])) {
                    continue;
                }

                $controlCenter = $this->createControlCenter($feature, $federalStateName);
                $this->createAddressForControlCenter($controlCenter, $properties);
            }

            $this->info("Import for {$fileName} completed.");
        }

        $this->info('ControlCenter import completed.');

        return 0;
    }

    protected function createControlCenter($feature, $federalStateName)
    {
        $properties = $feature['properties'];
        $geometry = $feature['geometry'];
        $osmId = $feature['id'];

        $district = District::query()->whereName(
            $federalStateName === 'Baden-Wurttemberg' ? 'Baden-Württemberg' : $federalStateName
        )->first();

        $coordinates = $geometry['type'] === 'Point'
            ? "{$geometry['coordinates'][1]} {$geometry['coordinates'][0]}"
            : $this->determinePolygonCenter(collect($geometry['coordinates'][0]));

        $controlCenter = ControlCenter::updateOrCreate(['osm_id' => $osmId], [
            'name' => $properties['name'],
            'location' => new Point($coordinates[0], $coordinates[1], Srid::WGS84->value),
            'website' => $properties['website'] ?? null,
            'osm_id' => $osmId,
            'district_id' => $district?->id ?? '00000000-0000-0000-0000-000000000000',
        ]);

        if ($controlCenter->wasRecentlyCreated) {
            $this->info(sprintf('Imported Control Center %s %s [OSM %s]', $controlCenter->id, $controlCenter->name, $osmId));
        }

        return $controlCenter;
    }

    protected function createAddressForControlCenter(ControlCenter $controlCenter, $properties)
    {
        if (isset($properties['addr:street']) || isset($properties['addr:city']) || isset($properties['addr:housenumber']) || isset($properties['addr:postcode'])) {
            $address = new Address([
                'city' => $properties['addr:city'] ?? '',
                'country' => $properties['addr:country'] ?? '',
                'county' => '',
                'street' => $properties['addr:street'] ?? '',
                'number' => $properties['addr:housenumber'] ?? '',
                'zip' => $properties['addr:postcode'] ?? '',
            ]);

            $controlCenter->address()->save($address);
        }
    }
}
