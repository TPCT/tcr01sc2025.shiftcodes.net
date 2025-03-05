<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
class UsersController extends Controller
{

    public function signup(Request $request) {
        $request->validateWithBag('signup',[
            "email" => "required|email|unique:users,email",
            // "phone" => "required|unique:users,phone",
            "name" => "required",
            "password" => "required"
        ],[
            "email.required" => "Email is required",
            "email.email" => "Invalid email",
            "email.unique" => "Email is already used",
            // "phone.required" => "رقم الهاتف مطلوب",
            // "phone.unique" => "رقم الهاتف مستخدم من قبل",
            "name.required" => "Name is required",
            "password.required" => "Password is required"
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['type']     = 'customer';
        $user = User::create($data);
        auth()->guard('customers')->login($user);
        return redirect()->route('website.account.phone');
    }

    public function login(Request $request) {
        $request->validateWithBag("login", [
            "email" => "required|email",
            "password" => "required"
        ],[
            "email.required" => "Email is required",
            "email.email" => "Invalid email",
            "password.required" => "Password is required"
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->guard('customers')->attempt($credentials)) {
            return redirect("/");
        }
        return redirect()->back()->withErrors(["email" => "Invalid email or password"], 'login');
    }

    public function logout() {
        auth()->guard('customers')->logout();
        return redirect("/");
    }

    public function phone() {
        return view("website::auth.phone-verify");
    }

    public function verify_user(Request $request) {
        $user = auth()->guard('customers')->user();
        $user->is_phone_verified = 1;
        $user->save();
        return response()->json([
            "status" => "success",
            "message" => "Phone verified successfully"
        ]);
    }

    public function login_with_provider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handle_provider_callback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return 'error';
        }
        $existingUser = User::where([['email', $user->getEmail()],["type","customer"]])->first();
        if ($existingUser) {
            auth()->guard('customers')->login($existingUser);
            return redirect('/');
        } else {
            $newUser                    = new User;
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->password          = bcrypt(Str::uuid());
            $newUser->type              = 'customer';
            $newUser->save();
            auth()->guard('customers')->login($newUser);
            return redirect()->route('website.account.phone');
        }
    }

    public function toggle_wish_list() {
        $car_id = request('car_id');
        $user = auth()->guard('customers')->user();
        if($user->wishlist->contains($car_id)) {
            $user->wishlist()->detach($car_id);
            return response()->json([
                "status" => "success",
                "action" => "remove",
            ]);
        } else {
            $user->wishlist()->attach($car_id);
            return response()->json([
                "status" => "success",
                "action" => 'add'
            ]);
        }
    }

    public function wishlist() {
        $user = auth()->guard('customers')->user();
        $wishlist = $user->wishlist()->paginate(10);
        return view("website::cars.wishlist", [
            "cars" => $wishlist
        ]);
    }
   
    public function register_fcm_token() {
        $token = request('token');
        $user = auth()->guard('customers')->user();
        $fcm = $user->fcms()->where('fcm_token', $token)->first();
        if(!$fcm) {
            $user->fcms()->create([
                'fcm_token' => $token
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => "Token registered successfully"
        ]);
    }
}
