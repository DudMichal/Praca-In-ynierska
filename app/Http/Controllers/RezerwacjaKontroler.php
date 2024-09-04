<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Hours;
use App\Models\Reservation;


class RezerwacjaKontroler extends Controller
{
    public function index()
    {
        $uslugi = Service::all();
        $pracownicy = Employee::all();
        return view('rezerwacja', ['services' => $uslugi, 'employees' => $pracownicy]);
    }
    public function wybierzUsluge(Request $request)
    {

        $usluga = Service::find($request->input('usluga_id'));
        $pracownicy = $usluga->employees()->get();
        return view('rezerwacjapracownik', ['services' => $usluga, 'employees' => $pracownicy]);

    }
    public function wybierzGodzina(Request $request)
    {
        $pracownik = Employee::find($request->input('pracownik_id'));
        $godziny = $pracownik->hours()->get();
        $usluga = $request->input('uslugaid');

        return view('rezerwacjagodzina', ['employee' => $pracownik, 'hours' => $godziny, 'services' => $usluga]);
    }

    public function rezerwuj(Request $request)
    {
        $godziny = Hours::find($request->input('godzina_id'));
        $pracownik = json_decode($request->input('pracownikid'), true);
        $usluga = json_decode($request->input('uslugaid'), true);

        if (!$godziny->is_reserved) {
            // Oznacz godzinę jako zarezerwowaną
            $godziny->is_reserved = true;
            $godziny->save();
            
            // Stwórz rekord rezerwacji
            $podsumowanie = Reservation::create([
                'employee_id' => $pracownik['id'],
                'service_id' => $usluga['id'],
                'customername' => $request->user()->name,
                'hour_id' => $godziny->id,
            ]);
            //return view('zarezerwuj', ['podsumowanie' => $podsumowanie]);
            return view('zarezerwuj', ['podsumowanie' => $podsumowanie]);
        } else {
            // Obsłuż sytuację, gdy godzina jest już zarezerwowana
            return redirect()->back()->with('error', 'Ta godzina jest już zarezerwowana. Proszę wybrać inną.');
        }
    }
}




