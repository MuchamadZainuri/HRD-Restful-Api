<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     *  method untuk register pengguna baru
     */
    public function register(Request $request){
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($input);

        $data = [
            'message' => 'User is created Successfully'
        ];

        return response()->json($data, 200);
    }

    /**
     *  method untuk login pengguna
     */
    public function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $input['email'])->first();

        $isLoginSuccessfully = (
            $input['email'] == $user->email
            &&
            Hash::check($input['password'], $user->password)
        );

        if ($isLoginSuccessfully) {
            $token = $user->createToken('auth_token');
            $data = [
                'messange' => 'Login Successfully',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);
        } else {

            $data = [
                'message' => 'Username or Password is wrong'
            ];

            return response()->json($data, 401);
        }
    }
}
