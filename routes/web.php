<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\ValidateCandidateOwner;
use Illuminate\Support\Facades\Route;

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
    return view('homepage');
});

Route::get('candidates-list', [CandidateController::class, 'index']);

Route::prefix('companies/{company}')->group(function () {
    Route::get('/balance', [CompanyController::class, 'getBalance']);
    Route::get('/candidates', [CompanyController::class, 'getCandidates']);

    Route::prefix('candidates/{candidate}')->middleware(ValidateCandidateOwner::class)->group(function() {
        Route::post('/contact', [CandidateController::class, 'contact']);
        Route::post('/hire', [CandidateController::class, 'hire']);
    });
});
