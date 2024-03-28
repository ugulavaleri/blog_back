<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(BlogPost $blogPost)
    {
        return response()->json([
            'message' => $blogPost->comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, BlogPost $blogPost)
    {
        $validatedData = $request->validated();

        $blogPost->comments()->create([
            ...$validatedData,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'comment added successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost,Comment $comment)
    {
        return response()->json([
            'message' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCommentRequest $request, BlogPost $blogPost, Comment $comment)
    {
        $comment->update($request->validated());
        return response()->json([
            'message' => 'comment updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost,Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'message' => 'comment removed successfully!'
        ]);
    }
}
