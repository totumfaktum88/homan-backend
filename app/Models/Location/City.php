<?php

namespace App\Models\Location;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends \Nnjeim\World\Models\City
{
    public function airports(): HasMany {
        return $this->hasMany(Airport::class);
    }
}
