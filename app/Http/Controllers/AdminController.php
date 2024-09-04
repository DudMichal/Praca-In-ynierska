<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesEmployees;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Hours;
use App\Models\Reservation;
use App\Models\ArchivedReservation;
use Illuminate\Pagination\Paginator;


class AdminController extends Controller
{
    public function adminpanel()
    {
        $pracownicy = Employee::all();
        return view('adminpanel', ['employees' => $pracownicy]);
    }

    public function dodajpracownika()
    {
        $pracownicy = Employee::all();
        return view('adminpanel.dodajpracownik', ['employees' => $pracownicy]);
    }
    public function powiazania()
    {
        $powiazania = ServicesEmployees::all();
        $pracownicy = Employee::all();
        $uslugi = Service::all();
        return view('adminpanel.dodajpracownikadouslugi', ['powiazania' => $powiazania, 'pracownicy' => $pracownicy, 'uslugi' => $uslugi]);
    }
    public function dodajusluge()
    {
        $uslugi = Service::all();
        return view('adminpanel.dodajusluge', ['services' => $uslugi]);
    }
    public function dodajtermin()
    {
        $pracownicy = Employee::all();
        $termin = Hours::whereDoesntHave('reservation')->get();
        return view('adminpanel.dodajtermin', ['hours' => $termin, 'pracownicy' => $pracownicy]);
    }
    public function rezerwacjelist()
    {
        $rezerwacje = Reservation::all();
        $zarchiwizowaneRezerwacje = ArchivedReservation::all();
        $pracownicy = Employee::all();
        $uslugi = Service::all();
        $termin = Hours::all();
        return view('adminpanel.spisrezerwacji', ['rezervation' => $rezerwacje, 'archivedReservations' => $zarchiwizowaneRezerwacje, 'pracownicy' => $pracownicy, 'services' => $uslugi, 'hours' => $termin]);
    }

    public function zbierzdane(Request $request)
    {
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'jobtitle' => 'required',
        ]);

        if ($validate) {
            $nowypracownik = new Employee();

            $nowypracownik->firstname = $request->firstname;
            $nowypracownik->lastname = $request->lastname;
            $nowypracownik->jobtitle = $request->jobtitle;

            $nowypracownik->save();

            return redirect('/pracownik');
        }
    }

    public function zbierzdaneUsluga(Request $request)
    {
        $validate = $request->validate([
            'servicename' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validate) {
            $nowausluga = new Service();

            $nowausluga->servicename = $request->servicename;
            $nowausluga->description = $request->description;
            $nowausluga->price = $request->price;

            $nowausluga->save();

            return redirect('/usługi');
        }
    }
    public function zbierzdanePowiazania(Request $request)
    {
        $validate = $request->validate([
            'service_id' => 'required',
            'employee_id' => 'required',
        ]);

        if ($validate) {
            $nowepowiazanie = new ServicesEmployees();

            $nowepowiazanie->service_id = $request->service_id;
            $nowepowiazanie->employee_id = $request->employee_id;

            $nowepowiazanie->save();

            return redirect('/adminpanel');
        }
    }
    public function zbierzdaneTermin(Request $request)
    {
        $validate = $request->validate([
            'employee_id' => 'required',
            'hours' => 'required',

        ]);

        if ($validate) {
            $nowadata = new Hours();

            $nowadata->employee_id = $request->employee_id;
            $nowadata->hours = $request->hours;
            $nowadata->is_reserved = false;

            $nowadata->save();

            return redirect('/adminpanel');
        }
    }
    public function completeReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_completed' => true]);

        // Przeniesienie do archiwum
        ArchivedReservation::create([
            'firstname' => $reservation->employee->firstname,
            'lastname' => $reservation->employee->lastname,
            'service' => $reservation->service->servicename,
            'customername' => $reservation->customername,
            'reservationdate' => $reservation->hour->hours,
        ]);

        $reservation->delete();

        return redirect('/adminpanel/spisrezerwacji')->with('success', 'Rezerwacja zakończona i przeniesiona do archiwum.');
    }
    public function editreservation(Request $request, $id)
    {
        //dd($id);
        $reservationId = Reservation::find($id);



        if ($reservationId != null) {
            $reservationId->employee_id = $request->employee_id;
            $reservationId->service_id = $request->service_id;

            $reservationId->save();


            return redirect('./adminpanel/spisrezerwacji');

        }
    }
    public function usunGodzine($id)
    {
        $godzina = Hours::find($id);

        $godzina->delete();

        return redirect('./adminpanel/dodajtermin');
    }

    public function edytujGodzine(Request $request)
    {
        $id = $request->id;

        // Pobierz obiekt godziny na podstawie ID
        $hour = Hours::findOrFail($id);

        // Zaktualizuj godzinę na podstawie danych z formularza
        $hour->hours = $request->datetime; // Przyjmuję, że w formularzu używasz nazwy datetime

        // Zapisz zaktualizowaną godzinę
        $hour->save();

        // Dodaj swoją logikę tutaj do aktualizacji daty dla określonego ID

        return redirect('./adminpanel/dodajtermin')->with('success', 'Termin zaktualizowany pomyślnie.');
    }

    public function edytujPracownika(Request $request)
    {
        $id = $request->id;

        // Pobierz obiekt pracownika na podstawie ID
        $employee = Employee::findOrFail($id);

        // Zaktualizuj pracownika na podstawie danych z formularza
        $employee->firstname = $request->imie;
        $employee->lastname = $request->nazwisko;
        $employee->jobtitle = $request->stanowisko;

        // Zapisz zaktualizowanego pracownika
        $employee->save();

        return redirect('./adminpanel/dodajpracownika')->with('success', 'Pracownik zaktualizowany pomyślnie.');
    }
    public function usunPracownika($id)
    {
        // Znajdź godziny powiązane z pracownikiem
        $hoursIds = \App\Models\Hours::where('employee_id', $id)->pluck('id')->toArray();

        // Usuń rezerwacje powiązane z godzinami
        \App\Models\Reservation::whereIn('hour_id', $hoursIds)->delete();

        // Usuń godziny powiązane z pracownikiem
        \App\Models\Hours::where('employee_id', $id)->delete();

        // Usuń pracownika
        $employee = \App\Models\Employee::find($id);
        $employee->delete();

        return redirect('./adminpanel/dodajpracownika');
    }
    public function edytujUsluge(Request $request)
    {
        $id = $request->usluga_id;

        // Pobierz obiekt usługi na podstawie ID
        $service = Service::findOrFail($id);

        // Zaktualizuj usługę na podstawie danych z formularza
        $service->servicename = $request->nazwa;
        $service->description = $request->opis;
        $service->price = $request->cena;

        // Zapisz zaktualizowaną usługę
        $service->save();

        return redirect('/adminpanel/dodajusluge')->with('success', 'Usługa zaktualizowana pomyślnie.');
    }
    public function usunUsluge($id)
    {
        $service = Service::find($id);

        $service->delete();

        return redirect('./adminpanel/dodajusluge');
    }
}

