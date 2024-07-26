<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airplane extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'available_seats',
        'row_count',
        'seat_count',
        'seat_order',
        'max_baggage_weight',
        'max_baggage_count'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'seat_order' => 'array'
        ];
    }
}
