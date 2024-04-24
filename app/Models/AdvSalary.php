<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvSalary extends Model
{
    use HasFactory;

    // Employee data
    public function emp()
    {
        return $this->belongsTo(Employees::class, "emp_id");
    }
}
