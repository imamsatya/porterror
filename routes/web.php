<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Models\Kegiatan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $user = Auth::user();

    $kegiatans = new Kegiatan;
    
    $bidang = $kegiatans->pluck('bidang')->unique()->toArray();
    // dd($bidang->toArray());
    $kegiatans = $kegiatans -> get();
    // dd($kegiatans);
    

    if ($user->kab_id !== 1) {
        return Redirect()->route('tabel')->with('user');
    } else {
        return Inertia::render('Dashboard', [
            'user' => $user,
            'kegiatans' => $kegiatans,
            'bidang' => $bidang,
        ] );
    }
})->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/tabel', function () {
//     return Inertia::render('Tabel');
// })->name('tabel');

Route::middleware(['auth:sanctum', 'verified'])->get('/tabel', [UserController::class, 'index'])->name('tabel');
Route::get('/gettabel', [UserController::class, 'getTabel']);

Route::post('/submitform', [UserController::class, 'store']);
Route::post('/submitjawaban', [UserController::class, 'jawabanStore']);

Route::post('/submitbalasan', [UserController::class, 'balasanStore']);

Route::post('/closethread/{id}', [UserController::class, 'closethread']);
Route::post('/openthread/{id}', [UserController::class, 'openthread']);

Route::post('/deletedata/{id}/delete', [UserController::class, 'destroy']);

Route::get('/kegiatan', [UserController::class, 'getKegiatan'])->name('kegiatan');


Route::post('/savekegiatan', [UserController::class, 'postKegiatan'])->name('postKegiatan');
Route::post('/editkegiatan', [UserController::class, 'editKegiatan'])->name('editKegiatan');
Route::post('/deletekegiatan', [UserController::class, 'deleteKegiatan'])->name('deleteKegiatan');

Route::get('/getselectedbidang/{id}', [UserController::class, 'getSelectedBidang'])->name('getSelectedBidang');