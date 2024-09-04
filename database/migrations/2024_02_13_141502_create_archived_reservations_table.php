<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archived_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('service');
            $table->string('customername');
            $table->dateTime('reservationdate');
            // Dodaj inne pola, jeśli są potrzebne
        });
    }

    public function down()
    {
        Schema::dropIfExists('archived_reservations');
    }
};
