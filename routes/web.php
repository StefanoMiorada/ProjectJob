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

    Route::group(["prefix" => "user"], function () { 
        //per gestire il ritorno sulla pag precedente al login
        Route::get('login/{source}/{message?}', [AuthController::class, 'authentication'])->name('user.login');
        Route::post('login/{source}/{message?}', [AuthController::class, 'login'])->name('user.login');
        
        Route::get('recuperaPassword', [AuthController::class, 'recuperaPassword'])->name('recuperaPassword');
        Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
        Route::post('register', [AuthController::class, 'registration'])->name('user.register');
        Route::post('{user}/update', [ControllerUser::class, 'update'])->name('user.updateDati');
        Route::get("ajaxLogin", [AuthController::class, "ajaxLogin"])->name("user.ajaxLogin");
        Route::get("ajaxUsername", [AuthController::class, "ajaxUsername"])->name("user.ajaxUsername");
    });
    Route::resource('user', ControllerUser::class);

    Route::group(["prefix" => "candidature"], function () {
        Route::get('{id}/destroy', [ControllerCandidature::class, 'destroy'])->name('candidatura.destroy');
        Route::get('{id}/destroy/confirm', [ControllerCandidature::class, 'confirmDestroy'])->name('candidatura.confirmDestroy');
        Route::post('{id}/update', [ControllerCandidature::class, 'update'])->name('candidatura.update');
    });
    Route::resource('candidature', ControllerCandidature::class);
    
    Route::resource('/paginaAzienda', ControllerPaginaAzienda::class);

    Route::group(["prefix" => "annunci"], function () {
        Route::post('{id}/update', [ControllerAnnunci::class, 'update'])->name('annuncio.update');
        Route::get('{id}/destroy', [ControllerAnnunci::class, 'destroy'])->name('annuncio.destroy');
        Route::get('{id}/destroy/confirm', [ControllerAnnunci::class, 'confirmDestroy'])->name('annuncio.confirmDestroy');
        Route::get('{id}/dettagli/candidature', [ControllerAnnunci::class, 'dettagliCandidature'])->name('annuncio.dettagliCandidature');
        Route::get('{id}/candidati', [ControllerAnnunci::class, 'candidaturaAnnuncio'])->name('annuncio.candidati');
        Route::post('{id}/inviaCandidatura', [ControllerAnnunci::class, 'inviaCandidatura'])->name('annuncio.inviaCandidatura');
    });
    Route::resource('annunci', ControllerAnnunci::class);
    
    //Route::get('/ajaxUsername', [AuthController::class, 'ajaxCheckUsername']);
});