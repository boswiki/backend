<?php

namespace App\Filters;

use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class ByName
{
    public function __construct(protected Request $request)
    {
        //
    }

    public function handle(SpatialBuilder $builder, \Closure $next)
    {
        return $next($builder)->when($this->request->has('name'),
            fn($query) => $query->where('name', 'REGEXP', $this->request->name)
        );
    }
}
