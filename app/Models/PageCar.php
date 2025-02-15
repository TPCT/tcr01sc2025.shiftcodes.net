<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'car_id'
    ];
}
