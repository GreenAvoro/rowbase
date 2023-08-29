<?php

use App\Models\Log;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/logs', function()
{
    $logs = Log::all();
    $logs_json = [];
    foreach($logs as $log)
    {
        $logs_json[] = [
            'user'      => $log->user->name,
            'workout'   => $log->workout->name
        ];
    }
    return json_encode($logs_json);
});