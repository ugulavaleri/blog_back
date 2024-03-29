<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BlogPostController;
    use App\Http\Controllers\CommentController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum');
    });

    Route::apiResource('blogPosts', BlogPostController::class);
    Route::apiResource('blogPosts.comments', CommentController::class)
        ->middleware('auth:sanctum');
    Route::get('/user',[AuthController::class,'currentUser'])
        ->middleware('auth:sanctum');




