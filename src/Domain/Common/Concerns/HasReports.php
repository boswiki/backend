<?php

namespace App\Concerns;

use Domain\Common\Models\Report;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasReports
{
    public function address(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
