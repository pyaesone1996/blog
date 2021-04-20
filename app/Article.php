<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Likeable;

    protected $guarded = [];

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'LIKE', "%$search%");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsto(User::class, 'author_id');
    }

    public function getFeaturedImage()
    {
        return asset('/storage/articles/' . $this->featured_image);
    }
}
