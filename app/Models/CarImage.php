<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $car_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'image',
    ];

    protected $hidden = ['created_at', 'updated_at','image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }
}
