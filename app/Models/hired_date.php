<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hired_date extends Model
{
    use HasFactory;

    protected $fillable = [
        'hired_on',
    ];

    // membuat relasi one to many dengan model employee
    public function employee()
    {
        return $this->hasMany(employee::class);
    }
}
