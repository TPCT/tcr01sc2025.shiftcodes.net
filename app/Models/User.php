<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'type',
        'status',
        'is_phone_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function company() {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function wishlist() {
        return $this->belongsToMany(Car::class, 'wishlists', 'user_id', 'car_id')->with(['images','brand','model','color','types','company','year']);
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function fcms() {
        return $this->hasMany(FCM::class, 'user_id', 'id');
    }

    public function sendFCM($title,$body) {
        $fcmTokens = $this->fcms->pluck('fcm_token')->toArray();
        foreach($fcmTokens as $token) {
            $url = 'https://fcm.googleapis.com/fcm/send';
              
            $serverKey = env('FCM_SERVER_KEY');
      
            $data = [
                "registration_ids" => [$token],
                "notification" => [
                    "title" =>$title,
                    "body" => $body,  
                ]
            ];
            $encodedData = json_encode($data);
        
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
          
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    
            // Execute post
            $result = curl_exec($ch);
    
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }        
    
            // Close connection
            curl_close($ch);
    
        }
 
        return true;
    }
}
