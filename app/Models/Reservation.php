<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Hours;

class Reservation extends Model
{
    protected $fillable = [
        self::ID,
        self::EMPLOYEEID,
        self::SERVICEID,
        self::CUSTOMERNAME,
        self::RESERVATIONDATE
    ];

    public const ID = 'id';
    public const EMPLOYEEID = 'employee_id';
    public const SERVICEID = 'service_id';
    public const CUSTOMERNAME = 'customername';
    public const RESERVATIONDATE = 'hour_id';

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function hour(): BelongsTo
    {
        return $this->belongsTo(Hours::class);
    }
}
