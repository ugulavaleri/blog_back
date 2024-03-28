<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests\LoginUserRequest;
use App\Http\Requests\AuthRequests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'success' => 'User Registered Successfully!',
            'access_token' => $user->createToken('user-token')->plainTextToken
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json([
                'error' => 'Credentials Do Not Match!'
            ], 401);
        }

        $user = User::whereEmail($data['email'])->first();

        return response()->json([
            'success' => 'User Logging Successfully!',
            'access_token' => $user->createToken('user-token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'success' => 'user logout successfully! '
        ]);
    }
}
