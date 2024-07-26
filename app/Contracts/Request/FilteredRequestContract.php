<?php

namespace App\Contracts\Request;

use Spatie\LaravelData\Data;

interface FilteredRequestContract
{
    public function toFilterData(): Data;
}
