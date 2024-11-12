<?php

use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\RouteController;
use Illuminate\Support\Facades\Route;


Route::get('/find-bus', [BusController::class, 'findBus'])->name('find-bus');


Route::post('/create-route', [RouteController::class, 'create']);
Route::post('/update-route', [RouteController::class, 'update']);
Route::post('/delete-route', [RouteController::class, 'delete']);

