<?php

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
    return view('index');
});

Route::prefix('/horarios')->group(function() {
    Route::get('/', function () {
        return view('schedules');
    });
    Route::get('/novo', function () {
        return view('newSchedule');
    });
    Route::get('/editar/{id}', function (int $id) {
        return view('newSchedule', ['id' => $id]);
    });
});

Route::prefix('/pessoas')->group(function() {
    Route::get('/', function () {
        return view('people');
    });
    Route::get('/novo', function () {
        return view('newPerson');
    });
    Route::get('/editar/{id}', function (int $id) {
        return view('newPerson', ['id' => $id]);
    });
});

Route::prefix('/medicamentos')->group(function () {
    Route::get('/', function() {
        return view('remedies');
    });
    Route::get('/novo', function() {
        return view('newRemedy');
    });
    Route::get('/editar/{id}', function (int $id) {
        return view('newRemedy', ['id' => $id]);
    });
});

Route::fallback(function () {
    return redirect('/');
});