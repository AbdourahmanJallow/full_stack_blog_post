<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::createUniqueSlug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = static::createUniqueSlug($post->title);
            }
        });
    }

    protected static function createUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        while (static::where('slug', $slug)->exists()) {
            $randomString = Str::random(6);
            $slug = "{$originalSlug}-{$randomString}";
        }

        return $slug;
    }
}
