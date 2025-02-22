<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $day
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $time_from
 * @property \Illuminate\Support\Carbon|null $time_to
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'type',
        'time_from',
        'time_to',
        'company_id',
    ];

    protected $casts = [
        'time_from' => 'datetime:H:i',
        'time_to' => 'datetime:H:i',
    ];
}
