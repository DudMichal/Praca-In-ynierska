<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employee;

class Hours extends Model
{
    protected $fillable = [
        self::ID,
        self::EMPLOYEEID,
        self::HOURS,
        self::IS_RESERVED
    ];
    public const ID = 'id';
    public const EMPLOYEEID = 'employee_id';
    public const HOURS = 'hours';
    public const IS_RESERVED = 'is_reserved';

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function hour(): HasOne
    {
        return $this->hasOne(Hours::class);
    }
    public function reservation()
{
    return $this->hasOne(Reservation::class, 'hour_id');
}
    
    public $timestamps = false;
    
    
}
