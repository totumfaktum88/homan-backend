<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingFlight extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'passenger_id',
        'flight_id',
        'row_number',
        'seat_letter',
        'baggage_weight'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        ];
    }

    public function flight(): BelongsTo {
        return $this->belongsTo(Flight::class);
    }
}
