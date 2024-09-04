<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\ServicesEmplyoees;
use App\Models\Hours;

class Employee extends Model
{
    protected $fillable = [
        self::ID,
        self::FIRSTNAME,
        self::LASTNAME,
        self::JOBTITLE
    ];
    public const ID = 'id';
    public const FIRSTNAME = 'firstname';
    public const LASTNAME = 'lastname';
    public const JOBTITLE = 'jobtitle';

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    public function services() : BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'services_employees', 'employee_id', 'service_id');
    }
    public function hours(): HasMany
    {
        return $this->hasMany(Hours::class, 'employee_id');
    }
}

