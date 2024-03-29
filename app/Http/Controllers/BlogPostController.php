<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPosts\StoreBlogPostRequest;
use App\Http\Requests\BlogPosts\UpdateBlogPostRequest;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
        $this->authorizeResource(BlogPost::class, 'blogPost');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPost::with('comments')->orderBy('created_at')->paginate(10);
        return response()->json([
            'data' => $blogPosts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {
        $validatedData = $request->validated();
        BlogPost::create([
            ...$validatedData,
            'user_id' => auth()->id()
        ]);

        return response()->json(['message' => 'blog post created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        return response()->json([
            'data' => $blogPost
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost->update($request->validated());

        return response()->json([
            'message' => 'Blog post updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return response()->json([
            'message' => 'blog post removed successfully!'
        ]);
    }
}
