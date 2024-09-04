<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Sprawdź, czy zalogowany użytkownik ma odpowiednią nazwę użytkownika
        if(auth()->check() && auth()->user()->name === 'admin') {
            return $next($request);
        }

        // Jeśli użytkownik nie ma odpowiednich uprawnień, przekieruj go lub wykonaj inną akcję
        return redirect('/')->with('error', 'Brak dostępu do tej strony.');
    }
}
