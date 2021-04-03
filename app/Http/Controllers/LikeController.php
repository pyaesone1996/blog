<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Article $article)
    {
        $article->like(Auth::id());

        return back();
    }

    public function destroy(Article $article)
    {
        $article->dislike(Auth::id());

        return back();
    }
}
