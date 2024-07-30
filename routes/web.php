<?php

use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Middleware\PengendaraMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AHPController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\PairwiseComparisonController;
use App\Http\Controllers\AlternativeValueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlternativeComparisonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CriteriaComparisonController;

// Route::get('a', [HomeController::class, 'index'])->name('ahp.calculate');
Route::get('/criteria_comparison', [CriteriaComparisonController::class, 'index'])->name('criteria_comparison.index');
Route::post('/criteria_comparison', [CriteriaComparisonController::class, 'store'])->name('criteria_comparison.store');
Route::get('/ahp/calculate', [AHPController::class, 'calculate'])->name('ahp.calculate');
Route::post('/alternatives/store', [AlternativeController::class, 'store'])->name('store.alternative');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('pairwise_comparisons', PairwiseComparisonController::class)->only(['create', 'store']);
Route::resource('alternative_comparison', AlternativeComparisonController::class);
Route::resource('alternative_comparisons', AlternativeComparisonController::class)->only(['create', 'store']);
Route::get('/ranking/results', [CriteriaComparisonController::class, 'showRankingResults'])->name('ranking.results');
//Perbandingan Criteria
Route::resource('criterias', CriteriaController::class);
//Criteria
Route::resource('alternatives', AlternativeController::class);
Route::resource('alternative_values', AlternativeValueController::class)->only(['create', 'store']);
Route::get('/hasil-rangking', [AHPController::class, 'calculate'])->name('ranking.results');


Route::middleware([EnsureUserIsAuthenticated::class])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware([AdminMiddleware::class])->group(function(){

});
Route::middleware([PengendaraMiddleware::class])->group(function(){

});
