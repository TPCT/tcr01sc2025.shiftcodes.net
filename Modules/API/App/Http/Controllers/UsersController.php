<?php

namespace Modules\API\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    function signup(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = \App\Models\User::create($data);
        $token = $user->createToken('auth')->accessToken;
        return response()->json([
            'status' => 'success',
            'token' => $token
        ]);
    }

    function login(Request $request) {
          $request->validate([
                'email' => 'required|email',
                'password' => 'required',
          ]);
          $data = $request->all();
          if (!auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password']
          ])) {
                return response()->json([
                 'status' => 'error',
                 'message' => 'Invalid credentials'
                ]);
          }
          $user = auth()->user();
          $token = $user->createToken('MyApp')->accessToken;
          return response()->json([
            'status' => 'success',
            'token' => $token
          ]);
    }

    function profile() {
        $user = auth()->user();
        return response()->json($user);
    }

    public function updateProfile(Request $request) {
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email,'.$user->id,
        ]);
        $data = $request->all();
        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        if($request->phone) {
            $data['is_phone_verified'] = 1;
        }
        $user->update($data);

        if($request->fcm_token) {
            $user->fcms()->updateOrCreate([
                'fcm_token' => $request->fcm_token
            ]);
        }
       
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully'
        ]);
    }

    public function logout() {
        $user = auth()->user();
        $user->tokens->each(function($token, $key) {
            $token->delete();
        });
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
