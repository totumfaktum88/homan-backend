<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flight\IndexRequest;
use App\Services\FlightService;

class FlightController extends Controller
{
    public function index(IndexRequest $request, FlightService $service) {
        return $service->list($request->toFilterData());
    }
}
