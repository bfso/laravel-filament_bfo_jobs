<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|min:8',
        ]);

        $company = Company::create([
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json($company,201);
    }

    public function login(Request $request){
        $crendentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($crendentials)) {
            return response()->json(["message" => "Invalid credentials"], 401);
        }

        return response()->json(Auth::user());
       
    }

    public function me(Request $request){
        return response()->json($request->user);
    }
}
