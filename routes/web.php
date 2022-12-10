<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ControllerAnnunci;
use App\Http\Controllers\ControllerPaginaAzienda;
use App\Http\Controllers\ControllerCandidature;
use App\Http\Controllers\ControllerUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
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
Route::middleware(['lang'])->group(function () {
    Route::get('/', [FrontController::class, 'getHome'])->name('home');
    Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');
    //Route::get('/home', function () {return redirect(route('home'));});
    Route::get('/home', [FrontController::class, 'getHome']);

    //per gestire il ritorno sulla pag precedente al login
    Route::get('/user/login/{source}', [AuthController::class, 'authentication'])->name('user.login');
    Route::post('/user/login/{source}', [AuthController::class, 'login'])->name('user.login');
    
    Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
    Route::resource('/paginaAzienda', ControllerPaginaAzienda::class);
    Route::resource('user', ControllerUser::class);
    Route::resource('annunci', ControllerAnnunci::class);
    Route::resource('candidature', ControllerCandidature::class);
    Route::get('/candidature/{id}/destroy', [ControllerCandidature::class, 'destroy'])->name('candidatura.destroy');
    Route::get('/candidature/{id}/destroy/confirm', [ControllerCandidature::class, 'confirmDestroy'])->name('candidatura.confirmDestroy');
    Route::post('/candidature/{id}/update', [ControllerCandidature::class, 'update'])->name('candidatura.update');
    Route::post('/user/{id}/update', [ControllerUser::class, 'update'])->name('user.update');
    Route::post('/annunci/{id}/update', [ControllerAnnunci::class, 'update'])->name('annuncio.update');
    Route::get('/annunci/{id}/destroy', [ControllerAnnunci::class, 'destroy'])->name('annuncio.destroy');
    Route::get('/annunci/{id}/destroy/confirm', [ControllerAnnunci::class, 'confirmDestroy'])->name('annuncio.confirmDestroy');
    Route::get('/annunci/{id}/dettagli/candidature', [ControllerAnnunci::class, 'dettagliCandidature'])->name('annuncio.dettagliCandidature');
    Route::get('/annunci/{id}/candidati', [ControllerAnnunci::class, 'candidaturaAnnuncio'])->name('annuncio.candidati');
    Route::post('/annunci/{id}/inviaCandidatura', [ControllerAnnunci::class, 'inviaCandidatura'])->name('annuncio.inviaCandidatura');
    
    //Route::get('/ajaxUsername', [AuthController::class, 'ajaxCheckUsername']);
});