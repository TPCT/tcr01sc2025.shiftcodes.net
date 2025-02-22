<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $type_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CarType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarType whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarType whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarType extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'type_id',
    ];
}
