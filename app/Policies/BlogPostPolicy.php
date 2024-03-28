<?php

    namespace App\Policies;

    use App\Models\BlogPost;
    use App\Models\User;
    use Illuminate\Auth\Access\Response;

    class BlogPostPolicy
    {
        /**
         * Determine whether the user can view any models.
         */
        public function viewAny(?User $user): bool
        {
            return true;
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(?User $user, BlogPost $blogPost): bool
        {
            return true;
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(?User $user): bool
        {
            return $user->hasRole('Admin') || $user->hasRole('Editor');
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, BlogPost $blogPost): bool
        {
            return $user->hasRole('Admin') ||
                $user->hasPermissionTo('crud own post');
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(User $user, BlogPost $blogPost): bool
        {
            return $user->hasRole('Admin') ||
                $user->hasPermissionTo('crud own post');
        }
    }
