<?php

namespace Domain\Stations\Actions;

use Domain\Stations\Models\Station;

class ShowStations
{
    public function __invoke()
    {
        return Station::all();
    }
}
