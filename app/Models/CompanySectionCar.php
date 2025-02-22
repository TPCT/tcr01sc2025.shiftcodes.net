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
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySectionCar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanySectionCar extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'section_id', 'car_id'];
}
