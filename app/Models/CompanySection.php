<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property int $max
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanySection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanySection extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'max', 'section_id'];
}
