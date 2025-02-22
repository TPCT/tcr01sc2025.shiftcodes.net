<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $feature_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarFeature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'feature_id',
    ];
}
