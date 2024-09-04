<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Reservation;
use App\Models\Employee;


class Service extends Model
{
    protected $fillable = [
        self::ID,
        self::SERVICENAME,
        self::DESCRIPTION,
        self::PRICE
    ];
    public const ID = 'id';
    public const SERVICENAME = 'servicename';
    public const DESCRIPTION = 'description';
    public const PRICE = 'price';

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    public function employees() : BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'services_employees', 'service_id', 'employee_id');
    }

}
