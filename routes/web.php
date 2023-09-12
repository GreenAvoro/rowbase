<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SquadController;
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

    if(Auth::user()->is_admin){
        $logs = $team->logs->sortByDesc('datetime')->take(20);
    }else {
        $logs = Auth::user()->logs;
    }
    return view('dashboard',[
        'logs' => $logs,
        'user' => Auth::user()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create-log', function () {
    return view('create-log',[
        'workouts' => Workout::all()
    ]);
})->middleware(['auth', 'verified'])->name('create-log');

Route::get('/log', [LogController::class, 'index'])->middleware(['auth', 'verified', 'is_admin'])->name('logs');
Route::get('/log/{id}', [LogController::class, 'view'])->middleware(['auth', 'verified'])->name('log.view');
Route::post('/submit-log', [LogController::class, 'store'])->name('submit.log');
Route::delete('/log/{id}', [LogController::class, 'destroy'])->name('log.destroy');

Route::get('/squads', [SquadController::class, 'index'])->middleware(['auth', 'verified', 'is_admin'])->name('edit-squads');
Route::get('squads/create', [SquadController::class, 'create'])->middleware(['auth', 'verified', 'is_admin'])->name('squad-create');
Route::post('/submit-squad', [SquadController::class, 'store'])->middleware(['auth', 'verified', 'is_admin'])->name('submit.squad');

Route::get('/users', [RegisteredUserController::class, 'index'])->middleware(['auth', 'verified', 'is_admin'])->name('users');
Route::post('/users', [RegisteredUserController::class, 'update'])->middleware(['auth', 'verified', 'is_admin'])->name('update.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
