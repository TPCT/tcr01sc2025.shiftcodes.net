<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasSlug;

class Currency extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'slug', 'code', 'aed_rate', 'default'];
}
