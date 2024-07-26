<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'departure_airport_id',
        'arrival_airport_id',
        'airplane_id',
        'departure_time',
        'arrival_time',
        //'price',
        'cancelled'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'arrival_time' => 'datetime',
            'departure_time' => 'datetime',
            'cancelled' => 'bool'
        ];
    }

    public function departureAirport(): BelongsTo {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport(): BelongsTo {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function airplane(): BelongsTo {
        return $this->belongsTo(Airplane::class);
    }
}
