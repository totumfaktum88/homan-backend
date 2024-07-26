<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id'
    ];

    public function passengers(): HasMany {
        return $this->hasMany(BookingPassenger::class);
    }

    public function flights(): HasMany {
        return $this->hasMany(BookingFlight::class);
    }
}
