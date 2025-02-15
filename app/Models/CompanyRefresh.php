<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRefresh extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'car_id',
    ];
}
