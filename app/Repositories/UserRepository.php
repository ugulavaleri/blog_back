<?php

    namespace App\Repositories;

    use App\Http\Requests\AuthRequests\LoginUserRequest;
    use App\Http\Requests\AuthRequests\StoreUserRequest;
    use App\Models\User;
    use App\Repositories\Interfaces\UserRepositoryInterface;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class UserRepository implements UserRepositoryInterface
    {
        public function login($request)
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
                'access_token' => $user->createToken('user-token')->plainTextToken,
                'user' => $user
            ]);
        }

        public function register($request)
        {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);
            $user->assignRole($request->role);

            return response()->json([
                'success' => 'User Registered Successfully!',
                'access_token' => $user->createToken('user-token')->plainTextToken,
                'user' => $user
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
