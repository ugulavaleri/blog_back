<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    public function __construct(
        public CommentRepositoryInterface $commentRepository
    )
    {
        $this->authorizeResource(Comment::class, 'comment');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(BlogPost $blogPost)
    {
        try {
            return $this->commentRepository->index($blogPost);
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
    public function store(StoreCommentRequest $request, BlogPost $blogPost)
    {
        try {
            return $this->commentRepository->store($request,$blogPost);
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
    public function show(BlogPost $blogPost,Comment $comment)
    {
        try {
            return $this->commentRepository->show($blogPost,$comment);
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
    public function update(StoreCommentRequest $request, BlogPost $blogPost, Comment $comment)
    {
        try {
            return $this->commentRepository->update($request,$blogPost,$comment);
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
    public function destroy(BlogPost $blogPost,Comment $comment)
    {
        try {
            return $this->commentRepository->destroy($blogPost,$comment);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
