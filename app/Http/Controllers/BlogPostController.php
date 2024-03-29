<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPosts\StoreBlogPostRequest;
use App\Http\Requests\BlogPosts\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Repositories\Interfaces\BlogPostRepositoryInterface;

class BlogPostController extends Controller
{
    public function __construct(
        public BlogPostRepositoryInterface $blogPostRepository
    )
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
        $this->authorizeResource(BlogPost::class, 'blogPost');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return $this->blogPostRepository->index();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {
        try {
            return $this->blogPostRepository->store($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        try {
            return $this->blogPostRepository->show($blogPost);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        try {
            return $this->blogPostRepository->update($request,$blogPost);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        try {
            return $this->blogPostRepository->destroy($blogPost);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
