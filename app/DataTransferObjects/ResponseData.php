<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Abstracts\Filter;

class ResponseData extends Filter
{
    public function __construct(
        public bool $success,
        public array $data = []
    ) {}
}
