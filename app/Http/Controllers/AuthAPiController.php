<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthAPiController extends Controller
{

    public function register(Request  $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password'])
        ]);


        $token = $user->createToken('myToken')->plainTextToken;


        $response = [
            "Message" => "Welocome in System",
            "Token" => $token,
            "user" => $user,
            "status" => "201"
        ];
        return response($response, 201);
    }

    public function login(Request  $request)
    {
        $data = $request->validate([

            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", '=', $data['email'])->first();



        if (!Hash::check($data['password'],   $user->password) && !$user) {
            $response = [
                "Message" => "Try Agien",
            ];
        }
        $token = $user->createToken('myToken')->plainTextToken;


        $response = [
            "Message" => "Welocome in System",
            "Token" => $token,
            "user" => $user,
            "status" => "201"
        ];
        return response($response, 201);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        $response = [
            "Message" => "Logout Done",
        ];
        return response($response, 201);
    }
}
