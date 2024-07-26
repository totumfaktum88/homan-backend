<?php

namespace App\Models\Location;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends \Nnjeim\World\Models\Country
{
    public function cities(): HasMany {
        return $this->hasMany(City::class);
    }
}
