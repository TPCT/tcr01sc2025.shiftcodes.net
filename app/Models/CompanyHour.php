<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'type',
        'time_from',
        'time_to',
        'company_id',
    ];

    protected $casts = [
        'time_from' => 'datetime:H:i',
        'time_to' => 'datetime:H:i',
    ];
}
