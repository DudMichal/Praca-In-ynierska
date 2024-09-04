<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kontroler;
use App\Http\Controllers\RezerwacjaKontroler;
use App\Http\Controllers\AdminController;
use App\Console\Commands\DeleteOldHours;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [Kontroler::class, 'zwrocDomowa']);
Route::get('/pracownik', [Kontroler::class, 'zwrocPracownik']);
Route::get('/usługi', [Kontroler::class, 'zwrocUslugi']);

Route::get('/loguj', [Kontroler::class,'zmienStanUwierzytelnienia']);
Route::get('/wyloguj', [Kontroler::class,'zmienStanUwierzytelnienia']);

Route::get('/rezerwacja', [RezerwacjaKontroler::class, 'index']) -> middleware('auth');
Route::post('/rezerwacja',[RezerwacjaKontroler::class, 'wybierzUsluge']) -> middleware('auth');

Route::post('/rezerwacjagodzina',[RezerwacjaKontroler::class, 'wybierzGodzina']) -> middleware('auth');
Route::post('/zarezerwuj',[RezerwacjaKontroler::class, 'rezerwuj']) -> middleware('auth');

Route::get('/adminpanel', [AdminController::class, 'adminpanel'])->middleware(['auth', 'admin']);

Route::get('/adminpanel/dodajpracownika', [AdminController::class, 'dodajpracownika'])->middleware(['auth', 'admin']);
Route::post('/adminpanel/saveEmployee',[AdminController::class, 'zbierzdane']) -> middleware('auth');

Route::get('/adminpanel/dodajusluge', [AdminController::class, 'dodajusluge'])->middleware(['auth', 'admin']);
Route::post('/adminpanel/saveService',[AdminController::class, 'zbierzdaneUsluga']) -> middleware('auth');
Route::post('/adminpanel/edytujusluge', [AdminController::class, 'edytujUsluge'])->name('edytujUsluge');
Route::delete('/usun-usluge/{id}', [AdminController::class, 'usunUsluge'])->name('usunUsluge');

Route::get('/adminpanel/dodajpracownikadosulugi', [AdminController::class, 'powiazania'])->middleware(['auth', 'admin']);
Route::post('/adminpanel/savePowiazanie',[AdminController::class, 'zbierzdanePowiazania']) -> middleware('auth');
Route::post('/adminpanel/edytujpracownika', [AdminController::class, 'edytujPracownika'])->name('edytujPracownika');
Route::delete('/usun-pracownika/{id}', [AdminController::class, 'usunPracownika'])->name('usunPracownika');

Route::get('/adminpanel/dodajtermin', [AdminController::class, 'dodajtermin'])->middleware(['auth', 'admin']);
Route::post('/adminpanel/saveHours',[AdminController::class, 'zbierzdaneTermin']) -> middleware('auth');
Route::delete('/usun-godzine/{id}', [AdminController::class, 'usunGodzine'])->name('usunGodzine');
Route::post('/adminpanel/edytuj-godzine', [AdminController::class, 'edytujGodzine'])->name('edytujGodzine');





Route::get('/adminpanel/spisrezerwacji', [AdminController::class, 'rezerwacjelist'])->middleware(['auth', 'admin']);
Route::post('/adminpanel/completeReservation/{id}', [AdminController::class, 'completeReservation'])->name('completeReservation')->middleware(['auth', 'admin']);

Route::post('/adminpanel/edit-reservation/{id}', [AdminController::class,'editreservation']);


// Route::get('/delete/old-hours', function () {
//     Artisan::call(DeleteOldHours::class);
// });

require __DIR__.'/auth.php';
