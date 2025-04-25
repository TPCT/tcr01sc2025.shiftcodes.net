<?php

namespace App\Helpers;


trait HasSlug
{
    public function getRouteKey(){
        return $this->slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function bootHasSlug(){
        static::creating(function ($model){
            if ($model->slug)
                return;
            $language = 'en';
            if (in_array('name', $model->translatable)){
                $slug = Utilities::slug($model->getTranslation('name', $language));
            }elseif (in_array('title', $model->translatable)){
                $slug = Utilities::slug($model->getTranslation('title', $language));
            }else{
                $slug = Utilities::slug(uniqid());
            }
            $count = static::where('slug', 'like', '%' . $slug . '%')->count();
            $model->slug = trim($slug . ($count ? "-" . ($count + 1) : ""), '-._?\\/');
        });
    }
}
