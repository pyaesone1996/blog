<?php

namespace App\Repositories;

use App\Article;

class ArticlesRepository
{
    public function search($query)
    {
        return Article::where('title', 'LIKE', "%$query%")
                        ->withlikes()
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
    }

    public function getAll()
    {
        return Article::latest()->withlikes()->paginate(15);
    }
}
