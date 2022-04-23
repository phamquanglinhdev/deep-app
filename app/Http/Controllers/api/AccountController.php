<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        if(User::where("email", "=", $request->email)->first()){
            $user = User::where("email", "=", $request->email)->first();
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json(
                    [
                        'message' => 'Login success',
                        'token'=>$token,
                        'type_token'=>'Bearer'

                    ],
                    200
                );
            }else{
                return response()->json(
                    [
                        'message' => 'invalid password',
                    ],
                    400
                );
            }
        }else{
            return response()->json(
                [
                    'message' => 'invalid email',
                ],
                400
            );
        }
    }

    public function register(Request $request)
    {
        if (!User::where("email", "=", $request->email)->first()) {
            $data = [
                'email' => $request->email,
                'name' => $request->name ?? "Anonymous User",
                'password' => Hash::make($request->password),
            ];
            if (User::create($data)) {
                return response()->json(
                    [
                        'message' => 'Register success',
                    ],
                    200
                );
            }
        } else {
            return response()->json(
                [
                    'message' => 'Existing Email',
                ],
                400
            );
        }
    }
}
