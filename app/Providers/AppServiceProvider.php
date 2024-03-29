<?php

namespace App\Providers;

use App\Repositories\BlogPostRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\BlogPostRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */public function register(): void
{
    $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
    $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
    $this->app->bind(BlogPostRepositoryInterface::class,BlogPostRepository::class);
}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
