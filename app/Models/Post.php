<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;
    protected $table = 'posts';
    protected $fillable = [
        'title_ar',
        'title_en',
        'slug_ar',
        'slug_en',
        'views',
        'content_ar',
        'content_en',
        'owner_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        // Optional: add conversions here
    }

    public function renameMediaFile(Media $media): void
    {
        $extension = pathinfo($media->file_name, PATHINFO_EXTENSION);
        $newFileName = \Str::slug($this->title_en) . '.' . now()->timestamp . '.' . $extension;

        $media->file_name = $newFileName;
        $media->save();
    }

    protected static function booted()
    {
        static::created(function ($post) {
            $post->slug_ar = self::generateSlug($post->title_ar, $post->id);
            $post->slug_en = self::generateSlug($post->title_en, $post->id);
            $post->saveQuietly(); // Use saveQuietly to avoid triggering another event
        });
    }

    public static function generateSlug($title, $id)
    {
        $base = preg_replace('/[^أ-يa-zA-Z0-9\s]+/u', '', $title);
        $base = preg_replace('/[\s\-]+/u', '-', trim($base));
        return mb_strtolower($base, 'UTF-8') . '-' . $id;
    }
//    public function getRouteKeyName()
//    {
//        return app()->getLocale() === 'ar' ? 'slug_ar' : 'slug_en';
//    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_posts');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
