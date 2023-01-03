<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplaceController;
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

Route::get('/', [ReplaceController::class, 'index']);
Route::get('/Create', function () {
    return view('uploadHtml');
});
Route::post('/create', [ReplaceController::class, 'save']);

Route::get('/edit/{id}', [ReplaceController::class, 'edit']);
Route::post('/edit/{id}', [ReplaceController::class, 'update']);
// Route::post("/replace")
Route::get('/delete/{id}', [ReplaceController::class, 'delete']);

Route::get('/replace/{id}', [ReplaceController::class, 'getHtmlReplace']);
Route::get('/getValue/{id}',[ReplaceController::class, 'getValue']);

Route::get('/navBar', function () {
    return view('navBar');
});
Route::get('/templateValue', function () {
    return view('templateKey');
});
Route::get('/saveJson', [ReplaceController::class, 'saveJson']);
