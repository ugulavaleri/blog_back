<?php

    namespace App\Repositories\Interfaces;

    use App\Http\Requests\AuthRequests\LoginUserRequest;
    use App\Http\Requests\AuthRequests\StoreUserRequest;

    interface UserRepositoryInterface
    {
        public function login(LoginUserRequest $request);
        public function register(StoreUserRequest $request);
        public function logout();
    }
