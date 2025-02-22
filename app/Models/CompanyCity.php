<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyCity extends Model
{
    use HasFactory;
}
