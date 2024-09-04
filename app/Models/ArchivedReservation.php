<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ArchivedReservation extends Model
{
    protected $fillable = [
        self::FIRSTNAME,
        self::LASTNAME,
        self::SERVICE,
        self::CUSTOMERNAME,
        self::RESERVATIONDATE

    ];

    public const FIRSTNAME = 'firstname';
    public const LASTNAME = 'lastname';
    public const  SERVICE = 'service';
    public const CUSTOMERNAME = 'customername';
    public const RESERVATIONDATE = 'reservationdate';

    public $timestamps = false;

}
