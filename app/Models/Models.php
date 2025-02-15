<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
class Models extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title','page_features','page_description'];

    protected $fillable = [
        'title',
        'brand_id',
        'type',
        'sync_id',
        'page_features',
        'page_description',
        'slug',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function cars() {
        return $this->hasMany(Car::class, 'model_id');
    }
}
