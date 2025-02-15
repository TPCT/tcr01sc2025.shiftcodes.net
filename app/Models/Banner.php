<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'link',
        'title',
        'company_id'
    ];

    protected $hidden = ['created_at', 'updated_at','image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
