<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    

    protected $guarded = [];
    public function employeeFees()
    {
        return $this->hasMany(Employees::class);
    }
}
