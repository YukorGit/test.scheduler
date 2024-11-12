<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property RouteStop[] $routeStops
 * @mixin Builder
 */
class Stop extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Связь с RouteStop
    public function routeStops()
    {
        return $this->hasMany(RouteStop::class);
    }
}
