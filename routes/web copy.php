<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kontroler;


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


Route::get('/', [Kontroler::class, 'zwrocDomowa']);
Route::get('/pracownik', [Kontroler::class, 'zwrocPracownik']);
Route::get('/usługi', [Kontroler::class, 'zwrocUslugi']);

// Route::get('/pracownik', function () {
//     return view('pracownik');
// });


