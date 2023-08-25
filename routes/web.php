<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Models\Log;
use App\Models\Team;
use App\Models\Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $team = Team::where(['id'=> Auth::user()->team_id])
                    ->first();
    return view('dashboard',[
        'logs' => $team->logs->sortByDesc('datetime')->take(20),
        'user' => Auth::user()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create-log', function () {
    return view('create-log',[
        'workouts' => Workout::all()
    ]);
})->middleware(['auth', 'verified'])->name('create-log');

Route::get('/log', [LogController::class, 'index'])->middleware(['auth', 'verified'])->name('logs');
Route::get('/log/{id}', [LogController::class, 'view'])->middleware(['auth', 'verified'])->name('log.view');
Route::post('/submit-log', [LogController::class, 'store'])->name('submit.log');
Route::delete('/log/{id}', [LogController::class, 'destroy'])->name('log.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
