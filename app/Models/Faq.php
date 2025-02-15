<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Faq extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['question','answer'];
    protected $fillable = [
        "question",
        "answer",
        "type",
        "resource_id"
    ];

    protected $hidden = ['created_at', 'updated_at', 'type', 'resource_id'];
}
