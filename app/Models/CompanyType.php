<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyType extends Model
{
    use HasFactory;
}
