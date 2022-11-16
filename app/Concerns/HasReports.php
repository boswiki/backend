<?php

namespace App\Concerns;

use App\Models\Address;
use App\Models\Report;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasReports
{
    public function address(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
