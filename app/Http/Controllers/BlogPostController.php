<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(BlogPost::class, 'blogPost');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPost::all();
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
        auth()->user()->assignRole('Admin');

        $blogPost = BlogPost::create([
            ...$validatedData,
            'author_id' => auth()->id()
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
