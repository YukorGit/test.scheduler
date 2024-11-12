<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RouteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    protected $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'bus_number' => 'required|string',
            'stops' => 'required|array|min:2',
            'frequency' => 'required|integer|min:1',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reverse_stops_to_start' => 'required|boolean',
            'stops_to_start' => 'required_if:reverse_stops_to_start,false|array|min:2',
        ]);

        return $this->routeService->createRoute($validatedData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'bus_number' => 'required|string',
            'stops' => 'required|array|min:2',
            'reverse_stops_to_start' => 'required|boolean',
            'stops_to_start' => 'required_if:reverse_stops_to_start,false|array|min:2',
        ]);

        return $this->routeService->updateRoute($validatedData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'bus_number' => 'required|string',
        ]);

        return $this->routeService->deleteRoute($validatedData);
    }
}
