<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id'
    ];
}
