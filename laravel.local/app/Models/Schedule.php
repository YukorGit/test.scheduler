<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $route_id
 * @property int $start_time
 * @property int $end_time
 * @property int $frequency
 * @mixin Builder
 */
class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['route_id', 'start_time', 'end_time', 'frequency'];

    // Связь с маршрутом
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
