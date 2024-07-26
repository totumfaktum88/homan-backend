<?php

namespace App\Enums\Booking;

enum PassengerEnum: int
{
    case adult = 18;
    case child = 2;

    case baby = 0;

}
