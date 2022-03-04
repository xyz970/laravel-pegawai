<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFees extends Model
{
    protected $guarded = [];
    
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo(EmployeeFees::class);
    }
}
