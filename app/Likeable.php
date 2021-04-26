<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait Likeable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select article_id , sum(liked) liked , sum(!liked) disliked from likes group by article_id',
            'likes',
            'likes.article_id',
            'articles.id'
        );
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user : Auth::id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function isLikeBy(User $user)
    {
        return (bool) $user->likes->where('article_id', $this->id)->where('liked', true)->count();
    }

    public function isDisLikeBy(User $user)
    {
        return (bool) $user->likes->where('article_id', $this->id)->where('liked', false)->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // public function toggleLike(User $user)
    // {
    //     return $this->like()->save($user);
    // }
}
