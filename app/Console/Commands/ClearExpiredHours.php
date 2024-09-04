<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Hours;
use Carbon\Carbon;

class ClearExpiredHours extends Command
{
    protected $signature = 'hours:clear-expired';
    protected $description = 'Usuwa wygasłe godziny z bazy danych';

    public function handle()
    {
        $now = Carbon::now();

        $expiredHours = Hours::where('hours', '<', $now)
            ->whereDoesntHave('reservation')
            ->get();

        foreach ($expiredHours as $hour) {
            $hour->delete();
        }

        $this->info('Wygasłe godziny bez powiązań z rezerwacjami zostały usunięte.');
    }
}