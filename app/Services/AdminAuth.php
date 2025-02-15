<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Interfaces\Auth\BaseAuth;
use Hash;

class AdminAuth implements BaseAuth
{

    protected $credentials;

    public $user;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function check()
    {
        $user = User::where('username', $this->credentials['username'])
                ->where('status', 1)
                ->first();
        if($user && Hash::check($this->credentials['password'], $user->password)) {
            $this->user = $user;
            return true;
        }
        return false;
    }

    public function login()
    {
        if($this->user) {
            Auth::login($this->user);
            if($this->user->type == 'admin' || $this->user->type == 'user') {
                return redirect('/admin');
            }
            return redirect('/');
        }
        return redirect('/');
    }
}