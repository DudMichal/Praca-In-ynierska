<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Service;
use App\Models\Employee;

class ServicesEmployees extends Model
{
    protected $fillable = [
        self::ID,
        self::SERVICE_ID,
        self::EMPLOYEE_ID
    ];
    public const ID = 'id';
    public const SERVICE_ID = 'service_id';
    public const EMPLOYEE_ID = 'employee_id';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public $timestamps = false;

}
