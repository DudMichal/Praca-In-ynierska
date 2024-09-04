<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hours;
use App\Models\Reservation;

class DeleteOldHoursCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old-hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old hours records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Usuń rekordy, których data jest wcześniejsza niż bieżąca data
        //  Hours::where('hours', '<', now())->delete();

        //  $this->info('Old hours records deleted successfully.');
      // Pobierz rekordy reservations, które mają powiązane rekordy z hours
    $reservationsToDelete = Reservation::whereHas('hours', function ($query) {
        $query->where('hours', '<', now());
    })->get();

    // Usuń powiązane rekordy z reservations
    $reservationsToDelete->each->delete();

    // Teraz możesz bezpiecznie usunąć rekordy z tabeli hours
    Hours::where('hours', '<', now())->delete();

    $this->info('Old hours records and related reservations deleted successfully.');

    }
}
