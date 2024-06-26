<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Comment extends Model
    {
        use HasFactory;

        protected $guarded = ['id'];

        public function blogPost(): BelongsTo
        {
            return $this->belongsTo(BlogPost::class);
        }

        public function user():BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
