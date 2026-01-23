<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\UseController;

Route::get('/', function () {return view('layout');});

Route::get('/auth/signin', [AuthController::class, 'signIn']);
Route::post('/auth/registr', [AuthController::class, 'registr']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::get('/things', [ThingController::class, 'index'])->name('things.index');
Route::get('/things/create', [ThingController::class, 'create'])->name('things.create');
Route::post('/things', [ThingController::class, 'store'])->name('things.store');
Route::get('/things/{thing}', [ThingController::class, 'show'])->name('things.show');
Route::get('/things/{thing}/edit', [ThingController::class, 'edit'])->name('things.edit');
Route::put('/things/{thing}', [ThingController::class, 'update'])->name('things.update');
Route::delete('/things/{thing}', [ThingController::class, 'destroy'])->name('things.destroy');

Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');
Route::post('/places', [PlaceController::class, 'store'])->name('places.store');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');
Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');
Route::put('/places/{place}', [PlaceController::class, 'update'])->name('places.update');
Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');

Route::get('/things/{thing}/use/create', [UseController::class, 'create'])->name('use.create');
Route::post('/things/{thing}/use', [UseController::class, 'store'])->name('use.store');