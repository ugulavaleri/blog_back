<?php

    namespace App\Repositories\Interfaces;

    use App\Http\Requests\BlogPosts\StoreBlogPostRequest;
    use App\Http\Requests\BlogPosts\UpdateBlogPostRequest;
    use App\Models\BlogPost;

    interface BlogPostRepositoryInterface{
        public function index();
        public function store(StoreBlogPostRequest $request);
        public function show(BlogPost $blogPost);
        public function update(UpdateBlogPostRequest $request, BlogPost $blogPost);
        public function destroy(BlogPost $blogPost);
    }
