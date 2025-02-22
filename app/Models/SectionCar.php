<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $section_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionCar extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'section_id', 'car_id'];
}
