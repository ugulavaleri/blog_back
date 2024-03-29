<?php

    namespace App\Repositories;

    use App\Http\Requests\Comments\StoreCommentRequest;
    use App\Models\BlogPost;
    use App\Models\Comment;
    use App\Repositories\Interfaces\CommentRepositoryInterface;

    class CommentRepository implements CommentRepositoryInterface
    {
        public function index(BlogPost $blogPost)
        {
            return response()->json([
                'message' => $blogPost->comments
            ]);
        }

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

        public function show(BlogPost $blogPost,Comment $comment)
        {
            return response()->json([
                'message' => $comment
            ]);
        }

        public function update(StoreCommentRequest $request, BlogPost $blogPost, Comment $comment)
        {
            $comment->update($request->validated());
            return response()->json([
                'message' => 'comment updated successfully!'
            ]);
        }

        public function destroy(BlogPost $blogPost,Comment $comment)
        {
            $comment->delete();
            return response()->json([
                'message' => 'comment removed successfully!'
            ]);
        }
    }
