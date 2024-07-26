<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\City;

class Airport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'city_id',
        'displayed_name',
        'geo_lat',
        'geo_lng'
    ];

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }
}
