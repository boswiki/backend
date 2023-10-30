<?php

namespace App\Api\Controllers;

use App\Controller;
use Domain\Stations\Models\ControlCenter;
use Domain\Stations\Models\District;
use Domain\Stations\Resources\ControlCenterResource;
use Domain\Stations\Resources\DistrictWithControlCenterResource;
use Illuminate\Http\Request;

class ControlCenterController extends Controller
{
    public function index()
    {
        return DistrictWithControlCenterResource::collection(
            District::query()
                ->select('id', 'name')
                ->whereType(\Domain\Stations\Enums\AdministrativeDivision::STATE->value)
                ->with('controlCenters:id,district_id,name,location')
                ->get()
        );
    }

    public function show(ControlCenter $controlCenter)
    {
        return ControlCenterResource::make(
            $controlCenter->load(
                'district:id,name',
                'address:id,number,street,city,addressable_id,addressable_type',
                'stations:id,name,control_center_id'
            )
        );
    }
}
