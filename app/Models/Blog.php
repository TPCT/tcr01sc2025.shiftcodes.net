<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Blog extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title','content'];

    protected $fillable = [
        'title',
        'content',
        'image'
    ];

    protected $hidden = ['created_at', 'updated_at','image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function seo()
    {
        return $this->belongsTo(SEO::class, 'id', 'resource_id');
    }
}
