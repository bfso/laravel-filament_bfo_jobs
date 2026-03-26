<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|min:8',
        ]);

        $plainTextToken = Str::random(64);
        $company = Company::create([
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => hash('sha256', $plainTextToken),
        ]);

        return response()->json([
            'company' => $company,
            'token' => $plainTextToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $company = Company::query()->where('email', $credentials['email'])->first();

        if (! $company || ! Hash::check($credentials['password'], $company->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $plainTextToken = Str::random(64);
        $company->forceFill([
            'api_token' => hash('sha256', $plainTextToken),
        ])->save();

        return response()->json([
            'company' => $company,
            'token' => $plainTextToken,
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
