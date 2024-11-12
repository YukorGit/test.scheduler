<?php

namespace App\Services;

use App\Models\Route;
use App\Models\RouteStop;
use Carbon\Carbon;

class SchedulerService
{

    /**
     * @param int $fromStopId
     * @param int $toStopId
     * @param int $count
     * @return array
     */
    public function getNextBuses(int $fromStopId, int $toStopId, int $count = 3): array
    {
        $buses = [];

        foreach (Route::getRoutesByStops($fromStopId, $toStopId) as $route) {
            $fromStop = $route->routeStops->firstWhere('stop_id', $fromStopId);
            $toStop = $route->routeStops->firstWhere('stop_id', $toStopId);
            $directionIsCorrect = false;

            if ($fromStop && $toStop) {
                $directionIsCorrect = $fromStop->stop_order < $toStop->stop_order;
            }

            if ($directionIsCorrect) {
                $nextArrivals = $this->getArrivalsTime($fromStop, $count);
                $endRouteStop = RouteStop::getEnd($fromStop->route_id);

                $buses[] = $this->mapScheduleForBus($nextArrivals, $endRouteStop);
            }
        }

        return $buses;
    }


    /**
     * @param array $nextArrivals
     * @param RouteStop $endRouteStop
     * @return array
     */
    private function mapScheduleForBus(array $nextArrivals,RouteStop $endRouteStop): array
    {
        return [
            'route' => "Автобус No{$endRouteStop->route->bus_number} в сторону ост.{$endRouteStop->stop->name}",
            'next_arrivals' => $nextArrivals
        ];
    }

    /**
     * @param RouteStop $fromStop
     * @param int $count
     * @return array
     */
    private function getArrivalsTime(RouteStop $fromStop, int $count = 3): array
    {
        $schedule = $fromStop->route->schedules;
        $frequency = $schedule->frequency;

        $timeZone = 'Europe/Moscow';
        $currentTime = Carbon::now($timeZone);
        $startTime = Carbon::parse($schedule->start_time, $timeZone);
        $endTime = Carbon::parse($schedule->end_time, $timeZone);

        $nextArrivals = [];
        $arrivalTime = $startTime->copy();

        if ($currentTime->greaterThanOrEqualTo($endTime) || $currentTime->lessThanOrEqualTo($startTime)) {
            while (count($nextArrivals) < $count) {
                $nextArrivals[] = $arrivalTime->format('H:i');
                $arrivalTime->addMinutes($frequency);
            }

            return $nextArrivals;
        }

        if ($fromStop->stop_order != 0) {
            $interval = $fromStop->stop_order * 5;
            $arrivalTime->addMinutes($interval);
        }

        while ($arrivalTime < $currentTime) {
            $arrivalTime->addMinutes($frequency);
        }

        $nextArrivals[] = $arrivalTime->format('H:i');

        while (count($nextArrivals) < $count) {
            $arrivalTime->addMinutes($frequency);

            if ($arrivalTime->greaterThanOrEqualTo($endTime)) {
                $arrivalTime = $startTime;
                $nextArrivals[] = $arrivalTime->format('H:i');
                continue;
            }

            $nextArrivals[] = $arrivalTime->format('H:i');
        }

        return $nextArrivals;
    }
}
