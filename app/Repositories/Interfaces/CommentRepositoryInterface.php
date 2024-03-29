<?php

    namespace App\Repositories\Interfaces;

    use App\Http\Requests\Comments\StoreCommentRequest;
    use App\Models\BlogPost;
    use App\Models\Comment;

    interface CommentRepositoryInterface{
        public function index(BlogPost $blogPost);
        public function store(StoreCommentRequest $request, BlogPost $blogPost);
        public function show(BlogPost $blogPost,Comment $comment);
        public function update(StoreCommentRequest $request, BlogPost $blogPost, Comment $comment);
        public function destroy(BlogPost $blogPost,Comment $comment);

    }
