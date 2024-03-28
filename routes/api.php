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

Route::get('blog-posts', [BlogPostController::class, 'index']);
Route::get('blog-posts/{blogPost}', [BlogPostController::class, 'show']);
Route::delete('blog-posts/{blogPost}', [BlogPostController::class, 'destroy']);
Route::put('blog-posts/{blogPost}', [BlogPostController::class, 'update']);
Route::post('blog-posts/create', [BlogPostController::class, 'store'])
    ->middleware('auth:sanctum');

Route::get('blog-posts/{blogPost}/comments', [CommentController::class, 'index']);
Route::get('blog-posts/{blogPost}/comments/{comment}', [CommentController::class, 'show']);
Route::delete('blog-posts/{blogPost}/comments/{comment}', [CommentController::class, 'destroy']);
Route::put('blog-posts/{blogPost}/comments/{comment}', [CommentController::class, 'update']);
Route::post('blog-posts/{blogPost}/comments', [CommentController::class, 'store'])
    ->middleware('auth:sanctum');


Route::group(['prefix' => 'user'],function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


