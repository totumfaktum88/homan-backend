<?php

namespace App\Enums\Booking;

enum AgeEnum: string
{
    case adult = 'adult';

    case child = 'child';

    case baby = 'baby';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
