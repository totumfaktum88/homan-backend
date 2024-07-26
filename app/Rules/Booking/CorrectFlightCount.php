<?php

namespace App\Rules\Booking;

use App\Enums\Booking\BookingTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorrectFlightCount implements ValidationRule
{
    protected $oneWayTripAttribute = null;

    public function __construct($oneWayTripAttribute) {
        $this->oneWayTripAttribute = $oneWayTripAttribute;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $itsCorrect = request()->boolean($this->oneWayTripAttribute) && $value == BookingTypeEnum::oneWayTrip->value ||
            !request()->boolean($this->oneWayTripAttribute) && $value == BookingTypeEnum::roundTrip->value;

        $fail(__('validation.booking.correct_flight_count'));
    }
}
