<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Services\SchedulerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BusController extends Controller
{
    /**
     * @param Request $request
     * @param SchedulerService $schedulerService
     * @return JsonResponse
     */
    public function findBus(Request $request, SchedulerService $schedulerService): JsonResponse
    {
        $request->validate([
            'from' => 'required|exists:stops,id',
            'to' => 'required|exists:stops,id',
        ]);

            try {
            $stopFrom = Stop::find($request->input('from'));
            $stopTo = Stop::find($request->input('to'));

            $buses = $schedulerService->getNextBuses($request->query('from'), $request->query('to'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка'], 500);
        }

        return response()->json([
            'from' => $stopFrom->name,
            'to' => $stopTo->name,
            'buses' => $buses
        ]);
    }
}
