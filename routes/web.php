<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);


Route::get('/about', function () {
   return view('main.about');
});
Route::get('/contact', function () {
   $array = [
      'name'=>'Moscow Polytech',
      'address'=>'B. Semenovskaya h.38',
      'email'=>'polytech@yandex.ru',
      'phone'=>'8-921-34-88-88'
   ];
   return view('main.contact', ['contact'=>$array]);
});