<?php

namespace Modules\Admin\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Services\AdminAuth;

class LoginController extends Controller
{

    protected static $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    protected static $messages = [
        'username.required' => 'اسم المستخدم مطلوب',
        'password.required' => 'كلمة المرور مطلوبة'
    ];

    public function index()
    {
        return view('admin::auth.login');
    }

    public function login(Request $request) {
        $request->validate(self::$rules, self::$messages);

        $credentials = $request->only('username', 'password');

        $auth       = new AdminAuth($credentials);
        $authorize  = $auth->check();

        if(!$authorize) {
            return redirect("/admin/login")->withErrors(["البريد الالكتروني او كلمة المرور غير صحيحة"]);
        }
      
        return $auth->login();        
    }


}
