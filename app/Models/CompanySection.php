<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySection extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'max', 'section_id'];
}
