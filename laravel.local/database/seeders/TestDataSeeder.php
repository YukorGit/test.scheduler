<?php

namespace Database\Seeders;

use App\Enums\DirectionEnum;
use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\RouteStop;
use App\Models\Schedule;
use App\Models\Stop;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $stop1 = Stop::create(['name' => 'ул. Пушкина']);
        $stop2 = Stop::create(['name' => 'ул. Ленина']);
        $stop3 = Stop::create(['name' => 'ул. Гагарина']);
        $stop4 = Stop::create(['name' => 'ул. Победы']);
        $stop5 = Stop::create(['name' => 'ул. Хохрякова']);
        $stop6 = Stop::create(['name' => 'ул. Мамина']);
        $stop7 = Stop::create(['name' => 'ул. Марченко']);
        $stop8 = Stop::create(['name' => 'Почта']);
        $stop9 = Stop::create(['name' => 'Первоозерный']);
        $stop10 = Stop::create(['name' => 'Театр драмы']);
        $stop11 = Stop::create(['name' => 'Железнодорожный вокзал']);
        $stop12 = Stop::create(['name' => 'Центральный рынок']);
        $stop13 = Stop::create(['name' => 'Кремлёвская набережная']);
        $stop14 = Stop::create(['name' => 'Горьковская площадь']);
        $stop15 = Stop::create(['name' => 'Университет']);
        $stop16 = Stop::create(['name' => 'Площадь Ленина']);
        $stop17 = Stop::create(['name' => 'Библиотека']);
        $stop18 = Stop::create(['name' => 'Парк победы']);

        $route1 = Route::create([
            'bus_number' => '11',
            'direction' => DirectionEnum::DIRECTION_TO_END
        ]);

        $route11 = Route::create([
            'bus_number' => '11',
            'direction' => DirectionEnum::DIRECTION_TO_START
        ]);

        $route2 = Route::create([
            'bus_number' => '21',
            'direction' => DirectionEnum::DIRECTION_TO_END
        ]);

        $route22 = Route::create([
            'bus_number' => '21',
            'direction' => DirectionEnum::DIRECTION_TO_START
        ]);

        $route3 = Route::create([
            'bus_number' => '31',
            'direction' => DirectionEnum::DIRECTION_TO_END
        ]);

        $route33 = Route::create([
            'bus_number' => '31',
            'direction' => DirectionEnum::DIRECTION_TO_START
        ]);


        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop1->id, 'stop_order' => 0]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop2->id, 'stop_order' => 1]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop3->id, 'stop_order' => 2]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop4->id, 'stop_order' => 3]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop5->id, 'stop_order' => 4]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop6->id, 'stop_order' => 5]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop7->id, 'stop_order' => 6]);
        RouteStop::create(['route_id' => $route1->id, 'stop_id' => $stop8->id, 'stop_order' => 7]);

        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop8->id, 'stop_order' => 0]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop7->id, 'stop_order' => 1]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop6->id, 'stop_order' => 2]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop5->id, 'stop_order' => 3]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop4->id, 'stop_order' => 4]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop3->id, 'stop_order' => 5]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop2->id, 'stop_order' => 6]);
        RouteStop::create(['route_id' => $route11->id, 'stop_id' => $stop1->id, 'stop_order' => 7]);

        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop6->id, 'stop_order' => 0]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop7->id, 'stop_order' => 1]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop8->id, 'stop_order' => 2]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop9->id, 'stop_order' => 3]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop10->id, 'stop_order' => 4]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop11->id, 'stop_order' => 5]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop12->id, 'stop_order' => 6]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop13->id, 'stop_order' => 7]);
        RouteStop::create(['route_id' => $route2->id, 'stop_id' => $stop14->id, 'stop_order' => 8]);

        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop14->id, 'stop_order' => 0]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop13->id, 'stop_order' => 1]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop12->id, 'stop_order' => 2]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop11->id, 'stop_order' => 3]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop10->id, 'stop_order' => 4]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop9->id, 'stop_order' => 5]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop8->id, 'stop_order' => 6]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop7->id, 'stop_order' => 7]);
        RouteStop::create(['route_id' => $route22->id, 'stop_id' => $stop6->id, 'stop_order' => 8]);

        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop10->id, 'stop_order' => 0,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop11->id, 'stop_order' => 1,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop12->id, 'stop_order' => 2,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop13->id, 'stop_order' => 3,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop14->id, 'stop_order' => 4,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop15->id, 'stop_order' => 5,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop16->id, 'stop_order' => 6,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop17->id, 'stop_order' => 7,]);
        RouteStop::create(['route_id' => $route3->id, 'stop_id' => $stop18->id, 'stop_order' => 8,]);

        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop18->id, 'stop_order' => 0]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop17->id, 'stop_order' => 1]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop16->id, 'stop_order' => 2]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop15->id, 'stop_order' => 3]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop14->id, 'stop_order' => 4]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop13->id, 'stop_order' => 5]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop12->id, 'stop_order' => 6]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop11->id, 'stop_order' => 7]);
        RouteStop::create(['route_id' => $route33->id, 'stop_id' => $stop10->id, 'stop_order' => 8]);


        Schedule::create([
            'route_id' => $route1->id,
            'start_time' => '08:00',
            'end_time' => '22:00',
            'frequency' => 30
        ]);

        Schedule::create([
            'route_id' => $route11->id,
            'start_time' => '08:00',
            'end_time' => '22:00',
            'frequency' => 30
        ]);

        Schedule::create([
            'route_id' => $route2->id,
            'start_time' => '07:00',
            'end_time' => '22:00',
            'frequency' => 20
        ]);

        Schedule::create([
            'route_id' => $route22->id,
            'start_time' => '07:00',
            'end_time' => '22:00',
            'frequency' => 20
        ]);

        Schedule::create([
            'route_id' => $route3->id,
            'start_time' => '07:30',
            'end_time' => '22:30',
            'frequency' => 10
        ]);

        Schedule::create([
            'route_id' => $route33->id,
            'start_time' => '07:30',
            'end_time' => '22:30',
            'frequency' => 10
        ]);
    }
}
