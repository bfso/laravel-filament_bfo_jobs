<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|min:8',
        ]);

        $company = Company::create([
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($company);
        $request->session()->regenerate();

        return response()->json($company, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return response()->json(["message" => "Invalid credentials"], 401);
        }

        $request->session()->regenerate();

        return response()->json($request->user());
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
