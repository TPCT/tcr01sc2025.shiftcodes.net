<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Content extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title','description','title_2','description_2','title_3','description_3'];


    protected $fillable = [
        "title",
        "description",
        "image",
        "type",
        "resource_id",
        "title_2",
        "description_2",
        "image_2",
        "title_3",
        "description_3",
        "image_3"
    ];
    protected $hidden = ['created_at', 'updated_at','image','type','resource_id'];
    protected $appends = ['image_url','image_url_2','image_url_3'];

    public function getImageUrlAttribute() {
        if(!$this->image) {
            return null;
        }
        return url('storage/'.$this->image);
    }

    public function getImageUrl2Attribute() {
        if(!$this->image_2) {
            return null;
        }
        return url('storage/'.$this->image_2);
    }

    public function getImageUrl3Attribute() {
        if(!$this->image_3) {
            return null;
        }
        return url('storage/'.$this->image_3);
    }
}
