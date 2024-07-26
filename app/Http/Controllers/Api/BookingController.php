<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Repository\StoreFailedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreRequest;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index(Request $request, BookingService $service) {
        return $service->list($request->toFilterData());
    }

    public function store(StoreRequest $request, BookingService $service): Response|JsonResource {
        try {
            return $service->store($request->toModelData());
        } catch (StoreFailedException $e) {
            return response(__('booking.store_failed'), 500);
        }
    }
}
