<?php


    namespace App\Repositories;

    use App\Http\Requests\BlogPosts\StoreBlogPostRequest;
    use App\Http\Requests\BlogPosts\UpdateBlogPostRequest;
    use App\Models\BlogPost;
    use App\Repositories\Interfaces\BlogPostRepositoryInterface;

    class BlogPostRepository implements BlogPostRepositoryInterface{
        public function index()
        {
            $blogPosts = BlogPost::with(['comments','user','comments.user'])->orderBy('created_at')->paginate(10);
            return response()->json([
                'data' => $blogPosts
            ]);
        }

        public function store(StoreBlogPostRequest $request)
        {
            $validatedData = $request->validated();
            BlogPost::create([
                ...$validatedData,
                'user_id' => auth()->id()
            ]);

            return response()->json(['message' => 'blog post created successfully!']);
        }

        public function show(BlogPost $blogPost)
        {
            return response()->json([
                'data' => $blogPost
            ]);
        }

        public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
        {
            $blogPost->update($request->validated());
            return response()->json([
                'message' => 'Blog post updated successfully!'
            ]);
        }

        public function destroy(BlogPost $blogPost)
        {
            $blogPost->delete();
            return response()->json([
                'message' => 'blog post removed successfully!'
            ]);
        }
    }
