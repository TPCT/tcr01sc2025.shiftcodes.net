<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyRefresh whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyRefresh extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'car_id',
    ];
}
