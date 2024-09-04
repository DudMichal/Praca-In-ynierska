<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;


class Kontroler extends Controller
{
    public function zwrocDomowa(){
         return view('domowa');
    }

    public function zwrocPracownik(){
        $pracownicy = Employee::all();

        return view('pracownik', ['eployees' => $pracownicy]);
   }

   public function zwrocUslugi(){
        $uslugi = Service::all();
    return view('usługi', ['services' => $uslugi]);
   }

   public function zmienStanUwierzytelnienia(){
 if(auth()->check()){
 $user = auth()->user();
 Auth::logout();
 return view('wylogowano');
 }
 else{
 return redirect('/register');
 }
}



}
