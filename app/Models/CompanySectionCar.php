<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySectionCar extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'section_id', 'car_id'];
}
