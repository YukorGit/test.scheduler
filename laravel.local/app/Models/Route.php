<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property RouteStop[] $routeStops
 * @property string $bus_number
 * @property string $direction
 * @mixin Builder
 */
class Route extends Model
{
    use HasFactory;

    protected $fillable = ['bus_number', 'direction'];

    public function routeStops()
    {
        return $this->hasMany(RouteStop::class);
    }


    public function schedules()
    {
        return $this->hasOne(Schedule::class);
    }

    /**
     * @param int $from
     * @param int $to
     * @return Collection
     */
    public static function getRoutesByStops(int $from, int $to): Collection
    {
        return self::whereHas('routeStops', function ($query) use ($from, $to) {
            $query->whereIn('stop_id', [$from, $to]);
        })->with(['routeStops' => function ($query) use ($from, $to) {
            $query->whereIn('stop_id', [$from, $to])->orderBy('stop_order');
        }])->get();
    }
}
