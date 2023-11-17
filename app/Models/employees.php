<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'address',
        'email',
        'employee_statuses_id',
        'hired_date_id',
    ];

    // membuat relasi many to one dengan model employee_status
    public function employee_status()
    {
        return $this->belongsTo(employee_status::class);
    }

    // membuat relasi many to one dengan model hired_date
    public function hired_date()
    {
        return $this->belongsTo(hired_date::class);
    }

}
