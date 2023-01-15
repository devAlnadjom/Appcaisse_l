<?php

use App\Http\Controllers\ApprobationController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Models\Demande;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/



Route::get('/', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('about', function () {
        return Inertia::render('About');
    })->name('about');


    Route::get('caisse/brouillard', [CaisseController::class, 'brouillard'])->name('caisse.brouillard');

    Route::post('caisse/approvisionner', [CaisseController::class, 'approvisionner'])->name('caisse.store_appro');
    Route::get('caisse/approvisionner', [CaisseController::class, 'appro_show_form'])->name('caisse.add_appro');

    Route::get('caisse/appro', [CaisseController::class, 'appro'])->name('caisse.appro_list');
    Route::get('caisse/pay/{demande}', [CaisseController::class, 'pay'])->name('caisse.pay');
    Route::post('caisse/payer', [CaisseController::class, 'payer'])->name('caisse.payer');
    Route::get('caisse', [CaisseController::class, 'index'])->name('caisse.index');

    Route::post('approbation/archive/{demande}', [ApprobationController::class, 'archive'])->name('approbation.archive');
    Route::post('approbation/authorize/{demande}', [ApprobationController::class, '_authorize'])->name('approbation.authorize');
    Route::post('approbation/reject/{demande}', [ApprobationController::class, 'reject'])->name('approbation.reject');
    Route::post('approbation/approuve/{demande}', [ApprobationController::class, 'approuve'])->name('approbation.approuve');
    Route::get('approbation/a_payer', [ApprobationController::class, 'waitingPayment'])->name('approbation.waitingPayment');
    Route::get('approbation', [ApprobationController::class, 'index'])->name('approbation.index');

    Route::get('demandes/autorization', [DemandeController::class, 'waitingMyAuthorization'])->name('demandes.authorization');
    Route::resource("demandes",DemandeController::class);


    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
    Route::resource('projets', \App\Http\Controllers\ProjetController::class);
    Route::resource('cdcs', \App\Http\Controllers\CdcController::class);
});
