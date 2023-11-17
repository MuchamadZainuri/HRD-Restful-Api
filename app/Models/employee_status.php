<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    // membuat relasi one to many dengan model employee
    public function employee()
    {
        return $this->hasMany(employee::class);
    }
}
