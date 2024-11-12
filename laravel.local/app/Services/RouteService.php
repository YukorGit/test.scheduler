<?php
namespace App\Services;

use App\Enums\DirectionEnum;
use App\Models\Route;
use App\Models\RouteStop;
use App\Models\Schedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RouteService
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function createRoute(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {

            $routeToEnd = Route::create([
                'bus_number' => $data['bus_number'],
                'direction' => DirectionEnum::DIRECTION_TO_END,
            ]);

            foreach ($data['stops'] as $order => $stopId) {
                RouteStop::create([
                    'route_id' => $routeToEnd->id,
                    'stop_id' => $stopId,
                    'stop_order' => $order,
                ]);
            }

            Schedule::create([
                'route_id' => $routeToEnd->id,
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'frequency' => $data['frequency'],
            ]);

            $routeToStart = Route::create([
                'bus_number' => $data['bus_number'],
                'direction' => DirectionEnum::DIRECTION_TO_START,
            ]);

            $stopsToStart = $data['reverse_stops_to_start']
                ? array_reverse($data['stops'])
                : $data['stops_to_start'];

            foreach ($stopsToStart as $order => $stopId) {
                RouteStop::create([
                    'route_id' => $routeToStart->id,
                    'stop_id' => $stopId,
                    'stop_order' => $order,
                ]);
            }

            Schedule::create([
                'route_id' => $routeToStart->id,
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'frequency' => $data['frequency'],
            ]);

            DB::commit();
            return response()->json(['message' => 'Маршрут успешно создан'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Ошибка создания маршрута'], 500);
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function updateRoute(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            $routeToEnd = Route::where('bus_number', $data['bus_number'])->where('direction', DirectionEnum::DIRECTION_TO_END)->firstOrFail();
            $routeToStart = Route::where('bus_number', $data['bus_number'])->where('direction', DirectionEnum::DIRECTION_TO_START)->firstOrFail();

            RouteStop::where('route_id', $routeToEnd->id)->delete();
            foreach ($data['stops'] as $order => $stopId) {
                RouteStop::create([
                    'route_id' => $routeToEnd->id,
                    'stop_id' => $stopId,
                    'stop_order' => $order,
                ]);
            }

            RouteStop::where('route_id', $routeToStart->id)->delete();
            $stopsToStart = $data['reverse_stops_to_start']
                ? array_reverse($data['stops'])
                : $data['stops_to_start'];

            foreach ($stopsToStart as $order => $stopId) {
                RouteStop::create([
                    'route_id' => $routeToStart->id,
                    'stop_id' => $stopId,
                    'stop_order' => $order,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Маршрут успешно обновлен'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Ошибка обновления маршрута'], 500);
        }
    }

    public function deleteRoute(array $data): JsonResponse
    {
        DB::beginTransaction();
        try {
            $routes = Route::where('bus_number', $data['bus_number'])->get();
            foreach ($routes as $route) {
                RouteStop::where('route_id', $route->id)->delete();
                Schedule::where('route_id', $route->id)->delete();
                $route->delete();
            }

            DB::commit();
            return response()->json(['message' => 'Маршрут успешно удален'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Ошибка удаления маршрута'], 500);
        }
    }
}
