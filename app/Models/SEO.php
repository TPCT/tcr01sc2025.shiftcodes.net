<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class SEO extends Model
{
    protected $table = 'seo';

    use HasFactory;
    use HasTranslations;

    public $translatable = ['description','keywords','meta_title'];


    protected $fillable = [
        "description",
        "keywords",
        "type",
        "resource_id",
        "meta_title"
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'id', 'resource_id');
    }
}
