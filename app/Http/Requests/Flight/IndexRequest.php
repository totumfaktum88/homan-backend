<?php

namespace App\Http\Requests\Flight;

use App\Contracts\Request\FilteredRequestContract;
use App\DataTransferObjects\Flight\FilterData;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements FilteredRequestContract
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
            'departure_city_id' => ['required', 'exists:cities,id'],
            'arrival_city_id' => ['required', 'different:departure_city_id', 'exists:cities,id'],
            'departure_time' => ['required', 'date'],
            'inbound_time' => ['required', 'date'],
            'one_way_trip' => ['required', 'boolean']
        ];
    }

    public function toFilterData(): FilterData
    {
        return FilterData::from($this->validated());
    }
}
