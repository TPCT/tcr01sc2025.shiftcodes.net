<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $page_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageCar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'car_id'
    ];
}
