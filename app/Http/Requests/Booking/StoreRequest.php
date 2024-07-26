<?php

namespace App\Http\Requests\Booking;

use App\DataTransferObjects\Booking\StoreData;
use App\Enums\Booking\AgeEnum;
use App\Enums\Booking\GenderEnum;
use App\Rules\Booking\CorrectFlightCount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required' => 'exists:users,id'],
            'departure_city_id' => ['required', 'exists:cities,id'],
            'inbound_city_id' => ['required', 'different:departure_city_id', 'exists:cities,id'],
            'one_way_trip' => ['boolean'],
            'departure_date' => ['required', 'date'],
            'inbound_date' => ['required_if:one_way_trip,1', 'date'],
            'passengers.*.first_name' => ['required', 'string'],
            'passengers.*.last_name' => ['required', 'string'],
            'passengers.*.age' => ['required', 'string', Rule::in(AgeEnum::values())],
            'passengers.*.gender' => ['required', 'string', Rule::in(GenderEnum::values())],
            'passengers.*.flights' => ['required'],
            //'flights' => ['required', 'array', new CorrectFlightCount('one_way_trip')],
            //'flights.*.row_number' => ['required_if:flights.*.seat_letter', 'number'],
            //'flights.*.seat_letter' => ['required_if:flights.*.row_number', 'string', ''],
            //'flights.*.baggage_weight' => ['sometimes', 'number'],
        ];
    }

    public function toModelData(): StoreData
    {
        return StoreData::from($this->validated());
    }
}
