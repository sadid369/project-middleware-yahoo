<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TestUser;
use App\Http\Middleware\ValidUser;
use GuzzleHttp\Middleware;
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

Route::get('/user', function () {
    return view('user');
})->name('user')->middleware('auth');
Route::view('register', 'register')->name('register');
Route::post('registerSave', [UserController::class, 'register'])->name('registerSave');
Route::view('login', 'login')->name('login');
Route::post('loginMatch', [UserController::class, 'login'])->name('loginMatch');
// Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash')->middleware([ValidUser::class, TestUser::class]);
// Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->middleware([ValidUser::class, TestUser::class]);
Route::get('logout', [UserController::class, 'logout'])->name('logout');
// Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash')->middleware(['ok-user']);
// Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->middleware(['ok-user']);
// Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash')->middleware(['isUserValid:reader,admin', TestUser::class]);
// Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->middleware(['isUserValid:reader,admin', TestUser::class]);
Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash')->middleware(['auth','isUserValid:admin']);
Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->middleware(['auth','isUserValid:admin']);

// Route::middleware(['isUserValid', TestUser::class])->group(function () {
//     Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash');
//     Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->withoutMiddleware([TestUser::class]);
// });
// Route::middleware('ok-user')->group(function () {
//     Route::get('dash', [UserController::class, 'dashboardPage'])->name('dash');
//     Route::get('inner', [UserController::class, 'innerPage'])->name('inner')->withoutMiddleware([TestUser::class]);;
// });
// Route::withoutMiddleware([TestUser::class])->group(function () {

//     Route::get('inner', [UserController::class, 'innerPage'])->name('inner');
// });
