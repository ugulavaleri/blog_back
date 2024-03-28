<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
    public function store(BlogPost $blogPost,Request $request)
    {
        $blogPost->comments()->create([
            'body' => $request->body,
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
    public function update(Request $request, BlogPost $blogPost, Comment $comment)
    {
        $comment->update($request->all());
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
