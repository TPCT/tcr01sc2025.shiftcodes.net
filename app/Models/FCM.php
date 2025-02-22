<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $fcm_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FCM newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FCM newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FCM query()
 * @method static \Illuminate\Database\Eloquent\Builder|FCM whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FCM whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FCM whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FCM whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FCM whereUserId($value)
 * @mixin \Eloquent
 */
class FCM extends Model
{
    use HasFactory;
    protected $table = 'fcms';
    protected $fillable = ['user_id', 'fcm_token'];
}
