<?php

use App\Domains\Evaluations\Http\Controllers\EvaluationController;
use App\Domains\Inspections\Http\Controllers\InspectionController;
use App\Domains\Instances\Http\Controllers\TestInstanceController;
use App\Domains\Tests\Http\Controllers\TestController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');



