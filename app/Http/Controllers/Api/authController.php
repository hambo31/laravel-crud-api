<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = User::where('email', $request->email)->where('superadmin', 1)->first();
            if (!$user) return response(['status' => false, 'message' => "User not found"]);
            if (strcmp($request->password, $user->password) == 0) {
                $token = $user->createToken($user->name)->accessToken;
                return response([
                    'status' => true,
                    'message' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Wrong Password'
                ]);
            }
        } catch (\Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
