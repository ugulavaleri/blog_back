<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\AuthRequests\LoginUserRequest;
    use App\Http\Requests\AuthRequests\StoreUserRequest;
    use App\Models\User;
    use App\Repositories\Interfaces\UserRepositoryInterface;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class AuthController extends Controller
    {
        public function __construct(public UserRepositoryInterface $userRepository){}

        public function register(StoreUserRequest $request)
        {
            try {
                return $this->userRepository->register($request);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }

        public function login(LoginUserRequest $request)
        {
            try {
                return $this->userRepository->login($request);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }

        public function logout()
        {
            try {
                return $this->userRepository->logout();
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }

        public function currentUser()
        {
            return response()->json([
                'user' => auth()->user()
            ]);
        }
    }
