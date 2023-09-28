<?php

namespace Tests\Feature\Common;

use Illuminate\Database\Migrations\Migrator;
use ReflectionMethod;
use ReflectionObject;
use Tests\TestCase;

/*
 We don't use down migrations because we don't want to ever run
 down in prod, it's too dangerous. If anything from an old
 migration needs to be undone, create a new migration for it.
*/

class NoDownMigrationsTest extends TestCase
{
    /** @test */
    public function there_are_no_down_migrations()
    {
        /** @var Migrator $migrator */
        $migrator = app('migrator');
        $getMigrationClass = new ReflectionMethod($migrator, 'getMigrationClass');
        $getMigrationClass->setAccessible(true);

        $files = $migrator->getMigrationFiles([
            $this->app->databasePath().DIRECTORY_SEPARATOR.'migrations',
        ]);

        $migrator->requireFiles($files);

        if (! $files) {
            $this->assertTrue(true);
        } else {
            foreach ($files as $file) {
                $name = $migrator->getMigrationName($file);
                $class = $getMigrationClass->invoke($migrator, $name);

                $instance = class_exists($class) ? new $class() : include $file;

                $reflector = new ReflectionObject($instance);

                $this->assertFalse(
                    $reflector->hasMethod('down'),
                    $name.' migration has a down method. Remove it right now!'
                );
            }
        }
    }
}
